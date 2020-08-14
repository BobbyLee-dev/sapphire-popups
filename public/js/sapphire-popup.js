/* 
 Sapphire Popups - JavaScript. 

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

	/*----------  End Helper Functions  ----------*/
		// Helper get element function
		function get(selector) {
			// console.log(document.querySelector(selector));
			return document.querySelector(selector);
		}
		// End Helper get element function

		// getall

		// Helper create markup function
		function createMarkUp(elementType, classList, content) {
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
		
		
		
	/*---------- Save popup behavior  ----------*/
		function checkAndSetSapphirePopupBehavior(behavior) {
		
			// Get popup title-id: data-sapphirepopupid
			const sapphirePopupID = sapphirePopupContent.split(' ')[1].split('"')[1];
			const currentTime = new Date().getTime();
			const popupExpiresValue = localStorage.getItem(sapphirePopupID);

			// Popup has been displayed before and behavior has been set.
			if (popupExpiresValue) {

				// Popup has been displayed and should not be shown again unless popup has been changed.
				if (behavior === 'show_once') {
					const previouslyDisplayedPopup = localStorage.getItem('sapphirePopupInLocalStorage');
					// If popup has not been changed/updated.
					if (previouslyDisplayedPopup === sapphirePopupContent) {
						return false;
					} else {
						// Popup has been changed/updated

						// Remove old popup from local Storage.
						localStorage.removeItem('sapphirePopupInLocalStorage');
						// Set new updated popup in local Storage.
						localStorage.setItem('sapphirePopupInLocalStorage', sapphirePopupContent);
						// Show new updated popup.
						return true;
					}
				} // End if behavior === show_once.

				// Show Daily
				if (behavior === 'show_daily') { }


			// Popup does has not been displayed yet.
			} else {
				// Show Once
				if (behavior === 'show_once') {
					localStorage.setItem(sapphirePopupID, 'show_once');
					localStorage.setItem('sapphirePopupInLocalStorage', sapphirePopupContent);
					return true;
				}

				// Show Daily
				if (behavior === 'show_daily') {}
			}
			
		}
	/*---------- End Save popup behavior  ----------*/
		

	
	/*----------  Display popup  ----------*/
		function displayPopup () {
			const sapphireBodyEl = get('body');
			const sapphirePopup = createMarkUp('div', ['sapphire-popup'], sapphirePopupContent);
			sapphireBodyEl.appendChild(sapphirePopup);
		}
	/*----------  End Display popup  ----------*/
		
	
	
	/*----------  Close Popup  ----------*/
		function closeSapphirePopup () {
			const sapphirePopupToClose = get('.sapphire-popup');
			if (sapphirePopupToClose) {
				sapphirePopupToClose.remove();
			}
		}
	/*----------  End Close Popup  ----------*/
		
	
	
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
		
		
	
	
	
	
	
	
		// Init
		function sapphirePopupInit() {
			displayPopup();
			sapphirePopupAddEventListeners();
		}



		const sapphirePopupBehavior = sapphirePopupContent.split(' ')[2].split('"')[1];
		

		if (sapphirePopupBehavior === 'default') {
			sapphirePopupInit();
		}


		if (sapphirePopupBehavior !== 'default') {
			if (checkAndSetSapphirePopupBehavior(sapphirePopupBehavior)) {				
				sapphirePopupInit();
			} else {
				// do nothing.
			}
		}
		
		// console.log('Sorry, popup behavior not recognized.');
		


	})() // End IIFE - private scope.
} // End if sapphirePopup