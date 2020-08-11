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

		
	/*----------  Get Popup Behavior  ----------*/
		function getSapphirePopupBehavior() {
			// console.log(sapphirePopupContent.split(' ')[1].split('"')[1]);


			// Default - returns -1 if no match was found.
			if (sapphirePopupContent.search('data-sapphirePopupBehavior="default"') !== -1) {
				return 'default';
			}

			// Show Once returns -1 if no match was found.
			if (sapphirePopupContent.search('data-sapphirePopupBehavior="show_once"') !== -1) {
				return 'show_once';
			}

			// Show Daily returns -1 if no match was found.
			if (sapphirePopupContent.search('data-sapphirePopupBehavior="show_daily"') !== -1) {		
				return 'show_daily';
			}

			return 'Popup Behavior not recconized.'
			
			
		}
	/*---------- End get Popup Behavior  ----------*/
		
		
		
	/*---------- Save popup behavior  ----------*/
		function checkAndSetSapphirePopupBehavior(behavior) {
		
			// check for behavior for this paticular popup
			const sapphirePopupID = sapphirePopupContent.split(' ')[1].split('"')[1];
			const currentTime = new Date().getTime();
			const popupExpiresDateFromLocalStorage = localStorage.getItem(sapphirePopupID);

			// If local storage popup exists and behavior === show_once don't show popup
			if (popupExpiresDateFromLocalStorage && behavior === 'show_once') {
				return false;
			}

			// If local storage popup does not exist and behavior === show_once set item in local storage and show popup.
			if (!popupExpiresDateFromLocalStorage && behavior === 'show_once') {
				localStorage.setItem(sapphirePopupID, 'show_once');
				return true;
			}

			// If local storage popup exists and time has not expired return false - dont show popup.
			if (popupExpiresDateFromLocalStorage && popupExpiresDateFromLocalStorage > currentTime && popupExpiresDateFromLocalStorage !== 'show_once') {
				
				return false;
			} 

			// If local storage popup exists, time has expired and behavoir == show_daily - remove local storage item re-add it with expires date, return true.
			if (popupExpiresDateFromLocalStorage && behavior === 'show_daily') {
			
				
				localStorage.removeItem(sapphirePopupID);
				// Set new expires date to cuttentTime plus 1 day in ms.
				// localStorage.setItem(sapphirePopupID, currentTime + 86400000);
				localStorage.setItem(sapphirePopupID, currentTime + 10000);
				return true;
			}

			if (!popupExpiresDateFromLocalStorage && behavior === 'show_daily') {


				
				// Set new expires date to cuttentTime plus 1 day in ms.
				// localStorage.setItem(sapphirePopupID, currentTime + 86400000);
				localStorage.setItem(sapphirePopupID, currentTime + 10000);
				return true;
			}

			return false;
			

			
			
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





		// Check for behavior
		const sapphirePopupBehavior = getSapphirePopupBehavior();
		

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