/**
 * Add missing class names to child blocks within an acf/hero
 */
import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';

// console.log("Let's do this.");

const withYourCustomBlockClass = createHigherOrderComponent((BlockListBlock) => {
	return (props) => {
		const { name, attributes } = props;
		let customClass = '';

		if (name != 'core/group' && name != 'core/buttons') {
			return <BlockListBlock {...props} />;
		}

		// Define an array of allowed parent block names
		const allowedParentBlocks = ['acf/hero', 'acf/hero-video'];

		// Get the parent block ID
		const parentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId)[0]; // Assuming it's the first parent block

		if (parentClientId) {
			const parentBlock = wp.data.select('core/block-editor').getBlock(parentClientId);

			if (parentBlock && allowedParentBlocks.includes(parentBlock.name)) {
				if (name === 'core/group') {
					customClass = 'content';
				} else {
					customClass = 'btn-row';
				}
			}
		}

		// Add the custom class if it's set
		if (customClass) {
			return <BlockListBlock {...props} className={customClass} />;
		}

		// If there's no parent or the parent isn't in the allowed list, keep the original class
		return <BlockListBlock {...props} />;
	};
}, 'withYourCustomBlockClass');

addFilter(
	'editor.BlockListBlock',
	'your-plugin/your-custom-class',
	withYourCustomBlockClass
);
