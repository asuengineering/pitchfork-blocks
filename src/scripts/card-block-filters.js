import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';

/**
 * Checks for acf/card-v2. Direct inner blocks of the basic card wrapper.
 * Adds missing classes to several inner blocks associated with the pattern.
 */
const udsCardInnerMarkup = createHigherOrderComponent((BlockListBlock) => {
	return (props) => {
		const { name, attributes } = props;
		const testBlocks = [
			'core/buttons',
			'core/button',
			'core/group',
			'core/post-featured-image',
			'core/post-terms'
		];
		let customClass = '';

		if (!testBlocks.includes(name)) {
			return <BlockListBlock {...props} />;
		}

		// Define an array of allowed parent block names
		const allowedParentBlocks = ['acf/card-v2'];

		// Get the ID of the immediate parent and grandparent block.
		const parentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId, true)[0];
		const grandParentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId, true)[1];

		if (parentClientId) {
			const parentBlock = wp.data.select('core/block-editor').getBlock(parentClientId);

			// Define the class map
			const classMap = {
				'core/group': 'card-body',
				'core/buttons': 'card-buttons',
				'core/post-featured-image': 'card-img-top',
				'core/post-terms': 'card-tags',
			};

			// Apply classMap classes according to the encountered block type.
			if (parentBlock && allowedParentBlocks.includes(parentBlock.name)) {
				if (classMap.hasOwnProperty(name)) {
					customClass = classMap[name];
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
	'pf-blocks/add-v2-card-classes',
	udsCardInnerMarkup
);

/**
 * Checks for acf/card-v2-header.
 * Adds missing classes for core/heading, core/post-title and other inner blocks.
 */
const udsCardHeaderInnerMarkup = createHigherOrderComponent((BlockListBlock) => {
	return (props) => {
		const { name, attributes } = props;
		const testBlocks = ['core/heading'];
		let customClass = '';

		if (!testBlocks.includes(name)) {
			return <BlockListBlock {...props} />;
		}

		// Define an array of allowed parent block names
		const allowedParentBlocks = ['acf/card-v2-header'];

		// Get the ID of the immediate parent and grandparent block.
		const parentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId, true)[0];

		if (parentClientId) {
			const parentBlock = wp.data.select('core/block-editor').getBlock(parentClientId);
			// console.log(parentBlock);

			// Define the class map
			const classMap = {
				'core/heading': 'card-title',
			};

			// Testing for core/group, core/buttons, core/heading
			if (parentBlock && allowedParentBlocks.includes(parentBlock.name)) {
				// Check if the name exists in the classMap
				if (classMap.hasOwnProperty(name)) {
					customClass = classMap[name];
				}
			}

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
	'pf-blocks/add-v2-card-header-classes',
	udsCardHeaderInnerMarkup
);

