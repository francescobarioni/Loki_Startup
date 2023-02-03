// On page scroll
$(document).ready(function () {
    $(window).scroll(function () {
        // Intro section
        $('.scroll-event-intro').each(function (i) {

            var bottom_of_element = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            if (bottom_of_window > bottom_of_element + 200) {
                if ($(this).hasClass('slide-down')) {
                    $(this).animate({"top": "0px"}, "slow");
                    $('#intro-img-1').delay(500).animate({"left": "0px"}, "slow");
                    $('#intro-img-2').delay(750).animate({"left": "0px"}, "slow");
                }
            }

        });
        $('#intro-img-2').each(function (i) {

            var bottom_of_element = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            if (bottom_of_window > bottom_of_element + 200) {
                $('#intro-img-3').animate({"top": "0px", "opacity": 1}, "slow");
            }

        });
        // Experience section
        $('.scroll-event-experience').each(function (i) {

            var bottom_of_element = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            if (bottom_of_window > bottom_of_element + 200) {
                $(this).animate({"opacity": 1}, "slow");
                $('#experience-img-1').delay(250).animate({"left": "0px"}, "slow");
                $('#experience-img-2').delay(500).animate({"left": "0px"}, "slow");
                $('#card-title-1').delay(1000).fadeTo(500, 1);
                $('#card-description-1').delay(1200).fadeTo(500, 1);
                $('#card-title-2').delay(1400).fadeTo(500, 1);
                $('#card-description-2').delay(1600).fadeTo(500, 1);
            }

        });
    });
});
