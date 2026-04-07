# Structured Data Module Usage

## Overview
The Structured Data module automatically generates JSON-LD markup for schema.org structured data to improve your website's SEO and search engine visibility.

## Features
- **LocalBusiness Schema**: For restaurants, shops, service providers
- **Organization Schema**: For companies, non-profits, institutions
- **Automatic JSON-LD Generation**: Converts form data to valid schema.org JSON-LD
- **Image Handling**: Automatically processes and serves uploaded images
- **Multi-language Support**: Handles translations for structured data
- **Admin Interface**: Easy-to-use form builder with dynamic fields

## How It Works

### 1. Admin Interface
Navigate to **Settings → Gestructureerde data** to:
- Create new structured data entries
- Choose between LocalBusiness and Organization schemas
- Fill in relevant fields (only non-empty fields are included in output)
- Upload images for logos and business photos
- Enable/disable individual entries

### 2. Automatic Output
The system automatically includes JSON-LD scripts in your website's `<head>` section when:
- Structured data is enabled: `config('website.structured_data.enabled')` = `true`
- You have enabled structured data entries
- Users visit any page on your website

### 3. Example Output

#### LocalBusiness Example
```json
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "My Restaurant",
  "description": "A beautiful family restaurant",
  "url": "https://myrestaurant.com",
  "telephone": "+31 6 12345678",
  "email": "mailto:info@myrestaurant.com",
  "address": [
    {
      "@type": "PostalAddress",
      "streetAddress": "Restaurant Street 123",
      "addressLocality": "Amsterdam",
      "postalCode": "1234AB",
      "addressCountry": "NL"
    }
  ],
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 52.3676,
    "longitude": 4.9041
  },
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "Monday",
      "opens": "09:00",
      "closes": "17:00"
    }
  ],
  "priceRange": "€€",
  "image": "https://yoursite.com/storage/img/structured_data/abc123_image.jpg",
  "logo": "https://yoursite.com/storage/img/structured_data/def456_logo.png"
}
```

#### Organization Example
```json
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "My Company",
  "description": "Leading provider of web solutions",
  "url": "https://mycompany.com",
  "email": "mailto:info@mycompany.com",
  "foundingDate": "2020-01-01",
  "founder": "John Doe",
  "logo": "https://yoursite.com/storage/img/structured_data/logo123.png",
  "sameAs": [
    "https://facebook.com/mycompany",
    "https://linkedin.com/company/mycompany"
  ]
}
```

## Field Types & Validation

### LocalBusiness Fields
- **name** (required): Business name
- **description**: Business description
- **url**: Website URL
- **telephone**: Phone number
- **email**: Contact email (automatically gets `mailto:` prefix)
- **address**: Multiple addresses supported
- **geo**: Geographic coordinates (latitude/longitude)
- **openingHoursSpecification**: Business hours (multiple entries)
- **priceRange**: Price indication (€, €€, €€€)
- **image**: Business photos
- **logo**: Business logo
- **menu**: Menu URL or description

### Organization Fields
- **name** (required): Organization name
- **description**: Organization description
- **url**: Website URL
- **telephone**: Phone number
- **email**: Contact email
- **address**: Organization address
- **logo**: Organization logo
- **image**: Organization photos
- **founder**: Founder name
- **foundingDate**: When the organization was founded
- **sameAs**: Social media links and other URLs

## Image Handling
- Images are uploaded to `/storage/img/structured_data/`
- Filenames are automatically made unique
- Old images are automatically deleted when updated
- Images are automatically included in JSON-LD with full URLs
- Uses Spatie Media Library for robust file handling

## Configuration
Enable/disable the module in `config/website.php`:
```php
'structured_data' => [
    'enabled' => true,
],
```

## Technical Implementation
- **Model**: `Galaxy\StructuredData\Models\StructuredData`
- **Schema Definition**: Dynamic schemas defined in `getFeatureSchema()`
- **JSON-LD Generation**: `toJsonLd()` method converts data to schema.org format
- **Auto-inclusion**: Included in `website::layouts.main` via `structured_data::block`
- **Permissions**: Uses Galaxy's permission system (`StructuredData::StructuredData.*`)

## SEO Benefits
- Improved search engine understanding of your business
- Enhanced rich snippets in search results
- Better local SEO for LocalBusiness schema
- Structured data helps Google display business information
- Can improve click-through rates from search results

## Future Extensions
The system is designed to be extensible. You can add new schema types by:
1. Adding new schema definitions to `getFeatureSchema()`
2. Updating the form request validation
3. Adding field handling logic in `processFieldForJsonLd()`

Currently supported: LocalBusiness, Organization
Planned: Event, Product, Article, FAQ, etc.