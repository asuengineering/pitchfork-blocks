/**
 * JS file to add block styles and variations to various core blocks. 
 * - core/paragraph, add lead style.
 * 
 */

 wp.domReady( () => {
    
    // Add .lead to core/paragraph block.
    wp.blocks.registerBlockStyle(
        'core/paragraph', [{
            name: 'lead',
            label: 'Lead',
            isDefault: false,
        }]
    );

});

