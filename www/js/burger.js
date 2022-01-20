// BURGER MENU
function toggleBurger() {


    /*alert('coucou');*/

    let hamburger = document.querySelector('.hamburger');
    let hamburger2 = document.getElementById('btnBurger');

    hamburger.classList.toggle('active');

}




document.addEventListener("DOMContentLoaded", function() {

    // Select the button
    let btn = document.getElementById("btnBurger");

    // Listening to events, when clicking on button
    btn.addEventListener('click', toggleBurger);




});