document.addEventListener("DOMContentLoaded", function() {
    function randomNum() {
        "use strict";
        return Math.floor(Math.random() * 9) + 1;
    }

    // Separate counters for each loop
    var time = 30;
    var i1 = 0, i2 = 0, i3 = 0;

    // Selectors for each digit
    var selector3 = document.querySelector('.thirdDigit');
    var selector2 = document.querySelector('.secondDigit');
    var selector1 = document.querySelector('.firstDigit');

    // Check if all selectors exist
    if (!selector1 || !selector2 || !selector3) {
        console.error("One or more selectors are missing in the DOM.");
        return;
    }

    // Loop for the third digit
    var loop3 = setInterval(function() {
        if (i3 > 40) {
            clearInterval(loop3);
            selector3.textContent = 4;
        } else {
            selector3.textContent = randomNum();
            i3++;
        }
    }, time);

    // Loop for the second digit
    var loop2 = setInterval(function() {
        if (i2 > 80) {
            clearInterval(loop2);
            selector2.textContent = 0;
        } else {
            selector2.textContent = randomNum();
            i2++;
        }
    }, time);

    // Loop for the first digit
    var loop1 = setInterval(function() {
        if (i1 > 100) {
            clearInterval(loop1);
            selector1.textContent = 4;
        } else {
            selector1.textContent = randomNum();
            i1++;
        }
    }, time);
});
