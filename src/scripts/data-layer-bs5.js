document.addEventListener('DOMContentLoaded', function () {

	function initBootstrapDataLayer() {
		/**
		 * Push events to data layer (Google Analytics)
		 * Used by Header and General events.
		 */
		const pushGAEvent = (event) => {
			const { dataLayer } = window;
			if (dataLayer) dataLayer.push(event);
		};

		// Accordions. Events emitted by the body which uses BS5 collapse.
		document.querySelectorAll('.accordion-body').forEach((element) => {

			element.addEventListener('hide.bs.collapse', function () {
				const name = element.getAttribute('id') || 'accordion-unk';
				const event = 'collapse';
				const action = 'hide';
				const type = 'click';
				const section = 'default';
				const region = 'main-content';
				const text = document.querySelector(`a[data-bs-target="#${element.id}"]`).textContent.slice(0, 40);

				console.log('Hide event. ' + name);

				pushGAEvent({
					name: name.toLowerCase(),
					event: event.toLowerCase(),
					action: action.toLowerCase(),
					type: type.toLowerCase(),
					section: section.toLowerCase(),
					region: region.toLowerCase(),
					text: text.toLowerCase(),
				});
			});

			element.addEventListener('show.bs.collapse', function () {
				const name = element.getAttribute('id') || 'accordion-unknown';
				const event = 'collapse';
				const action = 'show';
				const type = 'click';
				const section = 'default';
				const region = 'main-content';
				const text = document.querySelector(`a[data-bs-target="#${element.id}"]`).textContent.slice(0, 40);

				console.log('"Show yourself!" ~Elsa. ' + name);

				pushGAEvent({
					name: name.toLowerCase(),
					event: event.toLowerCase(),
					action: action.toLowerCase(),
					type: type.toLowerCase(),
					section: section.toLowerCase(),
					region: region.toLowerCase(),
					text: text.toLowerCase(),
				});
			});
		});

		// Alerts. Events emitted by the body which uses BS5 collapse.
		document.querySelectorAll('.alert').forEach((element) => {

			// While we are here, let's move the focus appropriately. We'll need the index later.
			// Recommendation from BS 5: https://getbootstrap.com/docs/5.2/components/alerts/#dismissing
			var allFocusableElements = document.querySelectorAll(
				'a[href], button, input, select, textarea, [tabindex]:not([tabindex="-1"])'
			);
			var alertButton = element.querySelector('.alert-close button');
			var dismissedIndex = Array.from(allFocusableElements).indexOf(alertButton);

			element.addEventListener('close.bs.alert', function () {
				const name = element.getAttribute('id') || 'alert-unknown';
				const event = 'dismiss';
				const action = 'close';
				const type = 'click';
				const section = 'default';
				const region = 'main-content';
				const text = element.querySelector('.alert-content').textContent.slice(0, 40);

				console.log('Close alert. ' + name);

				pushGAEvent({
					name: name.toLowerCase(),
					event: event.toLowerCase(),
					action: action.toLowerCase(),
					type: type.toLowerCase(),
					section: section.toLowerCase(),
					region: region.toLowerCase(),
					text: text.toLowerCase(),
				});

				if (dismissedIndex !== -1 && dismissedIndex < allFocusableElements.length - 1) {
					// Focus on the next element
					var nextElement = allFocusableElements[dismissedIndex + 1];
					nextElement.focus();
				}

			});

		});

	}

	initBootstrapDataLayer();

});

