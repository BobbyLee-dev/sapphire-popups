/* 
  Sapphire Popups - JavaScript. 

	Gets enqued from included/core-functions.php.
	- sapphire_popups_add_popup_script().

	Helper Functions
	 - get() - Simple element query selector.
	 - createMarkUp() - Takes el type, classList, content - returns element/node.


	displayPopup() - Appends popup to DOM.

	closeSapphirePopup() - Removes popup from DOM.

	sapphirePopupAddEventListeners() - Adds popup related events.
	 - sapphirePopupWindowClick()
	 - sapphireDocumentKeyPress()

	sapphirePopupShowOnce() - Handles the behavior for displaying the popup once only.
	sapphirePopupShowDaily() - Handles the behavior for displaying the popup once a day.

	checkAndSetSapphirePopupBehavior() - Gets the behavior set in the popup settings - backend of WP.

	sapphirePopupInit() - Displays popup and sets up event listeners.
*/



if (sapphirePopupContent) {
	
	(function () {

	/*----------  End Helper Functions  ----------*/
		// Helper get element function
		function get(selector) {
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
		
		
	
	/*----------  Display popup  ----------*/
		function displayPopup() {
			const sapphireBodyEl = get('body');
			const sapphirePopup = createMarkUp('div', ['sapphire-popup'], sapphirePopupContent);
			sapphireBodyEl.appendChild(sapphirePopup);
		}
	/*----------  End Display popup  ----------*/
		
	
	
	/*----------  Close Popup  ----------*/
		function closeSapphirePopup() {
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
		
		
	/*----------  Show Once logic  ----------*/
		function sapphirePopupShowOnce(popupExpiresValue, sapphirePopupID, previouslyDisplayedPopup) {
			if (popupExpiresValue) {

				// Remove expires date.
				localStorage.removeItem(sapphirePopupID);
				// Add Expires date
				localStorage.setItem(sapphirePopupID, 'never');
					// Show new updated popup.
				
				// If popup has not been changed/updated - don't show popup.
				if (previouslyDisplayedPopup === sapphirePopupContent) {
					return false;
				} else { // Popup has been changed/updated
					// Remove old popup from local Storage.
					localStorage.removeItem('sapphirePopupInLocalStorage');
					// Set new updated popup in local Storage.
					localStorage.setItem('sapphirePopupInLocalStorage', sapphirePopupContent);
					
					return true;
				}
			} else { // Popup does has not been displayed yet.
			
				// Remove expires date.
				localStorage.removeItem(sapphirePopupID);
				// Add Expires date
				localStorage.setItem(sapphirePopupID, 'never');
				localStorage.setItem('sapphirePopupInLocalStorage', sapphirePopupContent);
				return true;

			}

		}
	/*----------  End Show Once logic  ----------*/
		
		
		
	/*----------  Show Daily logic  ----------*/
		function sapphirePopupShowDaily(popupExpiresValue, sapphirePopupID, previouslyDisplayedPopup) {
			
			const currentTimeInMs = new Date().getTime();
			const oneDayInMs = 86400000;

			if (popupExpiresValue) {

				// If popup has been changed/updated or needs updated from show never - update values - show.
				if (previouslyDisplayedPopup !== sapphirePopupContent || popupExpiresValue === 'never') {
					
					// Remove old popup from local Storage.
					localStorage.removeItem('sapphirePopupInLocalStorage');
					// Set new updated popup in local Storage.
					localStorage.setItem('sapphirePopupInLocalStorage', sapphirePopupContent);
					// Set new expires date - first remove old one.
					localStorage.removeItem(sapphirePopupID);
					// New Expires date.
					localStorage.setItem(sapphirePopupID, currentTimeInMs + oneDayInMs);
			
					// Show new updated popup.
					return true;
				
				}
				
				 // Check expires value with current time and show if expired
				if (currentTimeInMs > popupExpiresValue) {
				
					// Set new expires date - first remove old one.
					localStorage.removeItem(sapphirePopupID);
					// New Expires date.
					localStorage.setItem(sapphirePopupID, currentTimeInMs + oneDayInMs);
					return true;

				} else {
					return false;
				}

			} else { // Popup does has not been displayed yet.
				
				localStorage.setItem(sapphirePopupID, currentTimeInMs + oneDayInMs);
				localStorage.setItem('sapphirePopupInLocalStorage', sapphirePopupContent);
				return true;

			}

		}
	/*----------  End Show Daily logic  ----------*/
	
		
		
	/*---------- Save popup behavior  ----------*/
		function checkAndSetSapphirePopupBehavior(behavior) {

			// Get popup title-id: data-sapphirepopupid
			const sapphirePopupID = sapphirePopupContent.split(' ')[1].split('"')[1];
			const popupExpiresValue = localStorage.getItem(sapphirePopupID);
			const previouslyDisplayedPopup = localStorage.getItem('sapphirePopupInLocalStorage');

			if (behavior === 'show_once') {
				return sapphirePopupShowOnce(popupExpiresValue, sapphirePopupID, previouslyDisplayedPopup);
			}

			if (behavior === 'show_daily') {
				return sapphirePopupShowDaily(popupExpiresValue, sapphirePopupID, previouslyDisplayedPopup);
			}
			
		}
	/*---------- End Save popup behavior  ----------*/
	
	
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
		
		
		


	})() // End IIFE - private scope.
} // End if sapphirePopup