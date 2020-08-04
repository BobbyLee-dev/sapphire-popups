// /* 
//   Sapphire Popups - JavaScript - core logic. 

//   Gets enqued from included/core-functions.php
//   - sapphire_popups_add_popup_script()
// */

// const test = document.querySelector('.sapphire-popup');
// console.log(test);
// test.style.display = 'flex';

var bodytest = document.querySelector('body');
let frag = document.createRange().createContextualFragment(sapphirePopup);

bodytest.appendChild(frag);
console.log(frag);