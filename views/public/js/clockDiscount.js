function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

function initializeClock(id, endtime) {
    var clock = document.getElementById(id);
    var daysSpan = clock.querySelector('.days');
    var hoursSpan = clock.querySelector('.hours');
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');

    function updateClock() {
        var t = getTimeRemaining(endtime);

        daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if (t.total <= 0) {
            clearInterval(timeinterval);
            daysSpan.innerHTML = 0;
            hoursSpan.innerHTML = '00';
            minutesSpan.innerHTML = '00';
            secondsSpan.innerHTML = '00';
        }
    }

    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
}

// Generate a random expiry date within the next 30 days
function getRandomExpiryDate() {
    var now = new Date();
    var randomDays = Math.floor(Math.random() * 30) + 1; // Random number of days (1 to 30)
    now.setDate(now.getDate() + randomDays); // Set the expiry date
    return now.toISOString(); // Convert to ISO string
}

// Initialize the clock with the random expiry date
document.addEventListener("DOMContentLoaded", function() {
    var clockDiv = document.getElementById('clockdiv-global');
    var randomExpiryDate = getRandomExpiryDate(); // Get random expiry date
    initializeClock('clockdiv-global', randomExpiryDate);
});
