/**
 * JS file to add block styles and variations to various core blocks.
 * - core/paragraph, add lead style.
 *
 */

 wp.domReady( () => {

    /**
     * Register styles associated with acf/alert
     */
    wp.blocks.registerBlockStyle(
        'acf/alert', [{
            name: 'alert-warning',
            label: 'Warning',
            isDefault: true,
        }]
    );

    wp.blocks.registerBlockStyle(
        'acf/alert', [{
            name: 'alert-success',
            label: 'Success',
            isDefault: false,
        }]
    );

    wp.blocks.registerBlockStyle(
        'acf/alert', [{
            name: 'alert-info',
            label: 'Information',
            isDefault: false,
        }]
    );

    wp.blocks.registerBlockStyle(
        'acf/alert', [{
            name: 'alert-error',
            label: 'Error',
            isDefault: false,
        }]
    );

	/**
     * Register styles associated with acf/profile-manual
     */

	wp.blocks.registerBlockStyle(
		'acf/profile-manual', [{
			name: 'large',
			label: 'Large',
			isDefault: false,
		}]
	);

	wp.blocks.registerBlockStyle(
		'acf/profile-manual', [{
			name: 'small',
			label: 'Small',
			isDefault: true,
		}]
	);

	wp.blocks.registerBlockStyle(
		'acf/profile-manual', [{
			name: 'micro',
			label: 'Micro',
			isDefault: false,
		}]
	);

});

