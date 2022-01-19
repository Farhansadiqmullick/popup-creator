if (typeof $ === 'undefined') var $ = jQuery;

const months = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
];
const weekdays = [
    'Sunday',
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
];

window.addEventListener('DOMContentLoaded', function () {
    const deadline = document.querySelector('.simple_timer');
    const items = document.querySelectorAll('.deadline-format h4');
    let dateItem = document.querySelector('.date-count h4')
    countDate = dateItem.dataset.countdown;
    let tempDate = new Date();
    let tempYear = tempDate.getFullYear();
    let tempMonth = tempDate.getMonth();
    let tempDay = tempDate.getDate();

    //months are zero Based
    function countTimer() {
        //set the time for never ending
        let countDate = dateItem.dataset.countdown;
        let tempDay = tempDate.getDate();
        let today = new Date().getTime();
        if (countDate > tempDay) {
            let countTime = new Date(tempYear, tempMonth, tempDay + (countDate - tempDay), 10, 11, 0);
            return countTime;
        } else if (today > tempDay) {
            let countTime = new Date(tempYear, tempMonth, tempDay + 3, 10, 11, 0);
            return countTime;
        } else {
            let countTime = new Date(tempYear, tempMonth, tempDay + 3, 10, 11, 0);
            return countTime;
        }
    }
    let futureDate = countTimer();
    // let futureDate = new Date(2022, 0, 16, 10, 11, 30);
    const year = futureDate.getFullYear();

    let month = futureDate.getMonth();
    month = months[month];

    let weekday = futureDate.getDay();
    weekday = weekdays[weekday];

    const date = futureDate.getDate();

    const hours = futureDate.getHours();
    let dayNight = '';
    if (hours > 12) {
        dayNight = 'pm';
    } else {
        dayNight = 'am';
    }

    const minutes = futureDate.getMinutes();

    const futureTime = futureDate.getTime();
    function getRemainingTime() {
        const today = new Date().getTime();

        let exceedTime = futureTime - today;
        //values are in miliseconds

        const oneDay = 24 * 60 * 60 * 1000;
        const oneHour = 60 * 60 * 1000;
        const oneMinute = 60 * 1000;
        const oneSecond = 1000;
        //calculate all the values
        let days = exceedTime / oneDay;
        days = Math.floor(days);

        let hours = Math.floor((exceedTime % oneDay) / oneHour)
        let minutes = Math.floor((exceedTime % oneHour) / oneMinute);
        let seconds = Math.floor((exceedTime % oneMinute) / oneSecond);

        //set values array
        const values = [days, hours, minutes, seconds];

        //format value
        function format(item) {
            if (item < 10) {
                return (item = `0${item}`);
            }
        }
        //countdown injected
        items.forEach(function (item, index) {
            item.innerHTML = values[index]
        });
        if (exceedTime < 0) {
            countTimer();
            // clearInterval(countdown);
            // deadline.innerHTML = `<h4>sorry! the giveaway has expired!</h4>`;
        }
    }

    //countdown
    let countdown = setInterval(getRemainingTime, 1000);

    //see inital values
    getRemainingTime();

});


const MagicPopup = {
    //el: $('#magic-popup'),
    timeout: 0,
    init() {
        MagicPopup.checkEvents();
        MagicPopup.run();
    },
    checkEvents() {
        // MagicPopup.el.on('click', function () {
        //   MagicPopup.close();
        // });
        $('.close-promo').on('click', function () {
            MagicPopup.close();
        });
    },
    timer: 5000,
    run() {
        let closedAt = localStorage.getItem('magicpopup');
        now = new Date().getTime();
        closedAt = new Date(closedAt).getTime();
        if (closedAt && now >= closedAt) {
            MagicPopup.open();
        } else {
            MagicPopup.close();
        }
        /**
         * kono vabey run() a timeout functionality rakha jabena
         */

        // if (closedAt && now >= closedAt) {
        //     setTimeout(function () {
        //         MagicPopup.open()
        //     }, MagicPopup.timer);
        // } else {
        //     MagicPopup.close();
        // }
    },

    open() {
        PlainModal.closeByEscKey = false;
        PlainModal.closeByOverlay = false;
        var modalels = document.querySelector('.modal-content');
        let delayedPopups = [];
        // var modals = [];
        //for (i = 0; i < modalels.length; i++) {
        var content = modalels;
        var modal = new PlainModal(content);
        var delay = modalels.getAttribute('data-delay');
        MagicPopup.timer = Number(delay);
        modal.closeButton = content.querySelector('.close-promo');
        if (modalels.getAttribute('data-exit') == '1') {
            if (delay > 0) {
                delayedPopups.push({ modal: modal, delay: MagicPopup.timer });
            }
            else {
                modal.open();
            }
        } else {
            exitmodals.push(modal);
        }
        // }

        for (i in delayedPopups) {
            setTimeout(function (i) {
                delayedPopups[i].modal.open();
            }, delayedPopups[i].delay, i
            );
        }
        clearTimeout(MagicPopup.timeout);
        //MagicPopup.el.fadeIn();
        console.log('Popup shown');
    },

    close() {
        //MagicPopup.el.hide(0);
        clearTimeout(MagicPopup.timer);
        localStorage.setItem('magicpopup', new Date());
        MagicPopup.timeout = setTimeout(() => {
            MagicPopup.open();
        }, MagicPopup.timer);
        console.log('Popup hidden');
    },
};

window.addEventListener('DOMContentLoaded', MagicPopup.init);