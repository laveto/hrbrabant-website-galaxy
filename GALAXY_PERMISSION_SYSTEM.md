# Galaxy Permission System Documentation

## Overview
Galaxy uses Spatie Permissions with an automated permission generation system that scans controllers and generates permissions based on routes.

## Permission Pattern
```
ModuleName::ControllerName.action
```

### Examples:
- `Member::Member.index` - View members list
- `Member::Member.create` - Create new member
- `Member::Member.edit` - Edit existing member
- `Member::Member.destroy` - Delete member
- `StructuredData::StructuredData.index` - View structured data list

## How It Works

### 1. Automatic Permission Generation
The `UserPermissionsSeeder` (`galaxy/modules/Admin/resources/database/seeders/UserPermissionsSeeder.php`):
- Scans all routes in the application
- Finds controllers that use the `HasRightsTrait`
- Generates permissions for each controller method
- Creates permissions in format: `ModuleName.ControllerName.method`

### 2. Controller Requirements
Controllers must:
- Use `HasRightsTrait`
- Define routes using `Route::adminModulesGroup()`
- Be resource controllers or define custom permission mappings

### 3. Standard Resource Permissions
For resource controllers, these permissions are automatically created:
- `index` - List/view items
- `create` - Show create form
- `store` - Save new item
- `show` - View single item
- `edit` - Show edit form  
- `update` - Save changes
- `destroy` - Delete item

### 4. Sidebar Configuration
In module sidebar config (`resources/config/sidebar.php`):
```php
[
    'action' => [App\Modules\YourModule\Http\Controllers\YourController::class, 'index'],
    'permission' => 'YourModule::YourController.index',
    // ...
]
```

### 5. View/Template Usage
In index views, reference permissions for action buttons:
```php
'createPermission' => 'YourModule::YourController.create',
```

## Running Permission Updates
After adding new controllers or routes:
```bash
php artisan db:seed --class="Galaxy\\Admin\\Resources\\Database\\Seeders\\UserPermissionsSeeder"
```

## Custom Permissions
Controllers can define extra permissions by implementing `getExtraPermissions()`:
```php
public function getExtraPermissions() {
    return ['customAction', 'specialAccess'];
}
```

## Role System
- `user` - Basic user role (empty permissions)
- `admin` - Admin role (empty permissions by default)
- `superadmin` - Full access to all permissions
- User with ID 1 automatically gets superadmin role

## Permission Groups
Configure in `galaxy/modules/Admin/resources/config/permissions.php`:
- `exclude` array defines which permissions to hide from specific user groups
- Groups like 'standaard' and 'marketing' can have restricted access

## Module Integration
1. Controller extends `Galaxy\Core\Http\Controllers\Controller`
2. Controller uses `HasRightsTrait`
3. Routes wrapped in `Route::adminModulesGroup()`
4. Sidebar uses proper permission format
5. Run UserPermissionsSeeder to generate permissions