/* 
	Sapphire Popups - JavaScript - core logic. 

	Gets enqued from included/core-functions.php
	- sapphire_popups_add_popup_script()
*/



if (sapphirePopupContent) {
	(function () {

				// Functions:
		// - get popup behavior - data behavior
		// - behavior check - check if has cookie - if so check if need to display popup.
		// - set up cookie/create cookie - to be used when popup closed. 
	
	
		// - in close event add cookie if needed.
		//

	/*----------  Helper Functions  ----------*/
		
		// Helper get element function
		function get (selector) {
			// console.log(document.querySelector(selector));
			return document.querySelector(selector);
		}
		// End Helper get element function

		// getall

		// Helper create markup function
		function createMarkUp (elementType, classList, content) {
			const element = document.createElement(elementType);
			if (classList.length > 0) {
				element.classList = classList.join(' ');
			}
			if (content) {
				element.innerHTML = content;
			}
			return element;
		}
		// End Helper create markup function
		
	/*----------  End Helper Functions  ----------*/

	
	
	/*----------  Display popup  ----------*/
		function displayPopup () {
			const sapphireBodyEl = get('body');
			const sapphirePopup = createMarkUp('div', ['sapphire-popup'], sapphirePopupContent);
			sapphireBodyEl.appendChild(sapphirePopup);
		}
	/*----------  End Display popup  ----------*/
		
	
	
	/*----------  Close Popup and Remove Event Listeners  ----------*/
		function closeSapphirePopup () {
			const sapphirePopupToClose = get('.sapphire-popup');
			if (sapphirePopupToClose) {
				sapphirePopupToClose.remove();
			}
		}
	/*----------  End Close Popup and Remove Event Listeners  ----------*/
		
	
	
	/*----------  Event Listeners  ----------*/
		function sapphirePopupAddEventListeners() {
			
			// Click Events
			function sapphirePopupWindowClick(event) {

				// Close Button
				if (event.target.classList.contains('close-sapphire-popup')) {
					closeSapphirePopup();
					window.removeEventListener('click', sapphirePopupWindowClick, false);
					return;
				}
				// End Close Button

				// Click outside of popup content
				if (event.target.classList.contains('sapphire-popup')) {
					closeSapphirePopup();
					window.removeEventListener('click', sapphirePopupWindowClick, false);
					return;
				}
				// End Click outside of popup content

				// Link click
				if (event.target.href) {
					closeSapphirePopup();
					window.removeEventListener('click', sapphirePopupWindowClick, false);
					return;
				}
				// End Link click

			}
			window.addEventListener('click', sapphirePopupWindowClick, false);
			// End Click Events

			// Key Press
			function sapphireDocumentKeyPress (event) {
					if(event.key === "Escape") {
						closeSapphirePopup();
						document.removeEventListener('keydown', sapphireDocumentKeyPress, false);
						return;
					}
			}
			document.addEventListener('keydown', sapphireDocumentKeyPress, false);
			// End Key Press



		}
	/*----------  End Event Listeners  ----------*/
	


		displayPopup();
		sapphirePopupAddEventListeners();

  




	})() // End IIFE - private scope.
} // End if sapphirePopup