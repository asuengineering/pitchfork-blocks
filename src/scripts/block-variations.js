/**
 * JS file to add block styles and variations to various core blocks.
 * - core/paragraph, add lead style.
 *
 */

wp.domReady(() => {

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
	 * Register styles associated with acf/card-v2
	 */

	wp.blocks.registerBlockStyle(
		'acf/card-v2', [{
			name: 'card-default',
			label: 'Default card',
			isDefault: true,
		}]
	);

	wp.blocks.registerBlockStyle(
		'acf/card-v2', [{
			name: 'card-degree',
			label: 'Degree card',
			isDefault: false,
		}]
	);

	wp.blocks.registerBlockStyle(
		'acf/card-v2', [{
			name: 'card-story',
			label: 'Story card',
			isDefault: false,
		}]
	);

	wp.blocks.registerBlockStyle(
		'acf/card-v2', [{
			name: 'card-Event',
			label: 'Event card',
			isDefault: false,
		}]
	);

});

