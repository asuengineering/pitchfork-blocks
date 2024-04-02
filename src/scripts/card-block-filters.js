import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';

/**
 * Add wrapper element to heading block within acf/card-v2
 */
const addCardHeadingWrapper = createHigherOrderComponent((BlockListBlock) => {
	return (props) => {
		const { name, attributes } = props;

		if (name != 'core/heading') {
			return <BlockListBlock {...props} />;
		}

		// Define an array of allowed parent block names
		const allowedParentBlocks = ['acf/card-v2'];

		// Get the ID of the immediate parent block.
		const parentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId, true)[0];
		console.log(parentClientId);

		if (parentClientId) {
			const parentBlock = wp.data.select('core/block-editor').getBlock(parentClientId);

			if (parentBlock && allowedParentBlocks.includes(parentBlock.name)) {
				return <div class='card-header'><BlockListBlock {...props} className='card-title' /></div>;
			}
		}

		// If there's no parent or the parent isn't in the allowed list, keep the original class
		return <BlockListBlock {...props} />;
	};
}, 'addCardHeadingWrapper');

addFilter(
	'editor.BlockListBlock',
	'pf-blocks/add-card-heading-wrapper',
	addCardHeadingWrapper
);
