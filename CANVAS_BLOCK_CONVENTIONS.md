# Canvas Block Coding Conventions

## Overview
Canvas blocks in the Galaxy framework follow specific patterns for consistency and maintainability. This document outlines the current conventions based on analysis of existing blocks.

## BlockPanel.vue Structure

### Template Structure
```vue
<template>
    <FloatingPanel title="Block Name">
        <div class="canvas::blocks-[category]-[blockname]-BlockPanel">
            <Tabs :tabs="['Tab 1', 'Tab 2']">
                <div slot="Tab 1">
                    <!-- Input components -->
                </div>
                <div slot="Tab 2">
                    <!-- More input components -->
                </div>
            </Tabs>
        </div>
    </FloatingPanel>
</template>
```

### Script Structure
```vue
<script>
import AbstractPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel';
import FloatingPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel';
import Tabs from "@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/Tabs";
// Import input components...

export default {
    extends: AbstractPanel,
    
    components: {
        FloatingPanel,
        Tabs,
        // List components...
    },
    
    // Component logic...
}
</script>
```

## Available Input Components

### Core Inputs (from @galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/)
- `TextInput` - Text field with accordion support
- `NumberInput` - Number input field  
- `SwitchInput` - Switch/toggle input for boolean values
- `ColorsInput` - Color picker with database colors
- `IconInput` - Icon selector
- `LinkInput` - Link/URL input
- `AnchorInput` - Anchor link input
- `MarginInput` - Margin/spacing controls
- `WebsitePageInput` - Internal page selector
- `CommonInputs` - Standard margin/padding/spacing inputs

### Helper Components
- `AccordionInput` (alias: `Input`) - Collapsible input wrapper from `helpers/Input.vue`
- `FloatingPanel` - Main panel wrapper
- `Tabs` - Tab container for organizing inputs

## Input Component Patterns

### TextInput Usage
```vue
<TextInput
    label="Field Label"
    instruction="Helper text for the field"
    :options="options"
    options-property="propertyName"
    :open="false"  <!-- Default accordion state -->
/>
```

### SwitchInput Usage  
```vue
<SwitchInput
    label="Toggle Label"
    instruction="What this toggle does"
    :options="options"
    options-property="propertyName"
    :items="[
        { value: '1', label: 'Yes'},
        { value: '0', label: 'No'},
    ]"
    defaultValue="0"
    :accordion="false"
    :spacing="{'horizontal': false, 'vertical': true}"
/>
```

### AccordionInput Usage
```vue
<accordion-input :open="true">
    <template #label>
        <div class="font-medium text-gray-600">Section Title</div>
    </template>
    <template #content>
        <!-- Nested inputs -->
    </template>
</accordion-input>
```

### ColorsInput Usage
```vue
<ColorsInput
    label="Color Label"
    instruction="Color description"
    :colors="colors"
    :options="options"
    options-property="colorProperty"
    :open="true"
    :accordion="false"
    :spacing="{ 'horizontal': false, 'vertical': true }"
/>
```

## Import Conventions

### Always use @galaxy imports:
```javascript
import AbstractPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel';
import FloatingPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel';
import TextInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/TextInput";
```

### Component aliases:
```javascript
import AccordionInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/helpers/Input";
// This is the accordion wrapper, not a specific input type
```

## Common Tab Structure

Most blocks use these tab patterns:
- `['Algemeen']` - General settings only
- `['Algemeen', 'Design']` - General + design settings  
- `['Maatwerk', 'Algemeen']` - Custom + general settings
- `['Maatwerk', 'Algemeen', 'Design']` - Full three-tab structure

## CSS Class Naming

Container div should follow pattern:
```
canvas::blocks-[category]-[blockname]-BlockPanel
```

Examples:
- `canvas::blocks-utils-button-BlockPanel`
- `canvas::blocks-modules-story-BlockPanel` 
- `canvas-blocks-custom-header-BlockPanel`

## Color Loading Pattern

For blocks with color inputs:
```javascript
data() {
    return {
        colors: null,
    };
},

async mounted() {
    await this.loadColors();
},

methods: {
    async loadColors() {
        let databaseColors = (await getDatabaseColors(true)).data;
        
        this.colors = ['transparent', 'white', 'black'];
        
        $.each(databaseColors, (item, value) => {
            if (typeof value !== 'string') {
                this.colors.push(...Object.values(value));
            } else {
                this.colors.push(value);
            }
        });
        
        this.colors = _.uniq(this.colors);
        // Format colors object...
    },
}
```

## Key Principles

1. **Always extend AbstractPanel** - Provides base functionality
2. **Use accordion pattern** - All inputs should support collapsible sections
3. **Import from @galaxy** - Never use relative imports for galaxy components
4. **Follow naming conventions** - CSS classes and component structure should be consistent
5. **Use proper spacing** - Configure spacing objects for visual consistency
6. **Provide instructions** - All inputs should have helpful instruction text
7. **Default values** - Always provide sensible defaults for input fields