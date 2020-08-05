/* 
	Sapphire Popups - JavaScript - core logic. 

	Gets enqued from included/core-functions.php
	- sapphire_popups_add_popup_script()
*/


if (sapphirePopup) {
	(function () {

	/*----------  Helper Functions  ----------*/
		
	// Helper get element function
		const get = function (selector) {
			// console.log(document.querySelector(selector));
			return document.querySelector(selector);
		}
		// End Helper get element function

		// getall

		// Helper create markup function
		const createMarkUp = function (elementType, classList, content) {
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

		// Function:
		// - get popup behavior - data behavior
		// - create cookie - indexdb - id - make 
		// - check for cookie - index db
		// - display popup
		// - event listeners
		// - add cookie
		// 

	 

		const sapphireBodyEl = get('body');
		let frag = document.createRange().createContextualFragment(sapphirePopup);

		sapphireBodyEl.appendChild(frag);
		console.log(frag);


	})() // End IIFE - private scope.
} // End if sapphirePopup