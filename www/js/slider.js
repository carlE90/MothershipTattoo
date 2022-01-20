// SLIDER DIV
const slider = document.getElementById('slider-wrapper');

// DIV CONTAINING SLIDER PHOTOS
const slides = document.querySelectorAll('.slide');

// GET ALL DIVS NO MATTER HOW MANY YOU ADD
const nbSlide = slides.length;

// SELECTOR OF THE CLASSES "ARROW"
const next = document.querySelector('.rightArrow');
const previous = document.querySelector('.leftArrow');

// COUNTER TO ADD OR REMOVE CLASS "ACTIVE"
let count = 0;

// SLIDER TIMER (setInterval)
let slideTimer;



// FUNCTION TO MOVE TO NEXT SLIDER 
function slidenext() {
    if (slides[count] !== undefined) {
        slides[count].classList.remove('active');
    }

    if (count < nbSlide - 1) {
        count++;
    } else {
        count = 0;
    }
    if (slides[count] !== undefined) {
        slides[count].classList.add('active');
    }
    //console.log(count);
}

// FUNCTION TO MOVE TO PREVIOUS SLIDER 
function slidepreviouse() {
    if (slides[count] !== undefined) {
        slides[count].classList.remove('active');
    }

    if (count > 0) {
        count--;
    } else {
        count = nbSlide - 1;
    }
    if (slides[count] !== undefined) {
        slides[count].classList.add('active');
    }
}


// FUNCTION TO CHANGE IMAGE BY USING KEY LEFT AND RIGHT ARROW
function keyPress(e) {
    //console.log(e);

    if (e.code === 'ArrowLeft') {
        slidepreviouse();
    } else if (e.code === 'ArrowRight') {
        slidenext();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Events to change the slide images with either keyboard or mouse
    if (next !== null) { // IF to avoid errors when not on page
        next.addEventListener('click', slidenext);
    };
    if (next !== null) {
        previous.addEventListener('click', slidepreviouse);
    };
    document.addEventListener('keydown', keyPress);

    // Timer of the slider
    slideTimer = setInterval(slidenext, 4000);
})