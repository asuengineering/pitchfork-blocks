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

	// Register block variation for card-header
	wp.blocks.registerBlockVariation(
		'core/heading',
		{
			name: 'card-header',
			title: 'Card Header',
			description: 'The header tag that show up within a card.',
			attributes: {
				level: 3, // Set the default heading level to H3
				className: 'wp-card-header'
			}
		}
	);

});

