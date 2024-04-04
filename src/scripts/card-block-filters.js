import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';

/**
 * Add wrapper element to heading block within acf/card-v2
 */
const udsCardInnerMarkup = createHigherOrderComponent((BlockListBlock) => {
	return (props) => {
		const { name, attributes } = props;
		const testBlocks = ['core/heading', 'core/buttons', 'core/button', 'core/group'];
		let customClass = '';
		let customWrap = false;

		if (!testBlocks.includes(name)) {
			return <BlockListBlock {...props} />;
		}

		// Define an array of allowed parent block names
		const allowedParentBlocks = ['acf/card-v2'];

		// Get the ID of the immediate parent and grandparent block.
		const parentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId, true)[0];
		const grandParentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId, true)[1];
		// console.log(parentClientId);

		if (parentClientId) {
			const parentBlock = wp.data.select('core/block-editor').getBlock(parentClientId);

			// Testing for core/group, core/buttons, core/heading
			if (parentBlock && allowedParentBlocks.includes(parentBlock.name)) {
				if (name === 'core/heading') {
					customClass = 'card-title';
					customWrap = true;
				} else if (name === 'core/group') {
					customClass = 'card-body';
				} else if (name === 'core/buttons') {
					customClass = 'card-buttons'
				}
			}

			const grandParentBlock = wp.data.select('core/block-editor').getBlock(grandParentClientId);

			// Testing for core/button as a grandchild of acf/card-v2
			if (grandParentBlock && allowedParentBlocks.includes(grandParentBlock.name)) {
				if (name === 'core/button') {
					customClass = 'card-button';
				}
			}
		}

		// Add the custom class and custom wrap if both are set.
		if (customClass && customWrap) {
			return <div class='card-header'><BlockListBlock {...props} className='card-title' /></div>;
		}

		// Add just custom class if it's set
		if (customClass) {
			return <BlockListBlock {...props} className={customClass} />;
		}

		// If there's no parent or the parent isn't in the allowed list, keep the original class
		return <BlockListBlock {...props} />;
	};
}, 'udsCardInnerMarkup');

addFilter(
	'editor.BlockListBlock',
	'pf-blocks/add-card-heading-wrapper',
	udsCardInnerMarkup
);
