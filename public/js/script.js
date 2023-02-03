/*!
=========================================================
* Dorang Landing page
=========================================================

* Copyright: 2019 DevCRUD (https://devcrud.com)
* Licensed: (https://devcrud.com/licenses)
* Coded by www.devcrud.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
*/

// video autoplay on click
$('#play-video').on('click', function () {
    $('#video').prop('src', 'https://www.youtube.com/embed/dRp5VbWCQ3A?autoplay=1');
    $(document).add(parent.document).mouseup(function() {
        $('#video').prop('src', '');
    });
});

// Header animation
$('.header-title.fade-in').delay(500).fadeTo(800, 1);
$('.header-subtitle.fade-in').delay(1200).fadeTo(750, 1);
$('#play-video').delay(1700).fadeTo(500, 1);

 // toggle
$(document).ready(function(){
    // Set right theme before page load
    if (Cookies.get('theme')) {
        $('body').addClass('light-theme');
        $('body').removeClass('dark-theme');
        $('footer').addClass('light-theme');
        $('.breadcrumb').addClass('light-theme');
    }
    $('#html').css('visibility', 'visible');

    $('.search-toggle').click(function(){
        $('.search-wrapper').toggleClass('show');
    });

    $('.modal-toggle').click(function(){
        $('.modalBox').toggleClass('show');
    })

    $('.modalBox').click(function(){
        $(this).removeClass('show');
    });

    $('.spinner').click(function(){
        $(".theme-selector").toggleClass('show');
    });


    // Theme
    $('.light').click(function(){
        $('body').addClass('light-theme');
        $('body').removeClass('dark-theme');
        $('footer').addClass('light-theme');
        $('.breadcrumb').addClass('light-theme');
        Cookies.set('theme', 'light');
    });
    $('.dark').click(function(){
        $('body').toggleClass('dark-theme');
        $('body').removeClass('light-theme');
        $('footer').removeClass('light-theme');
        $('.breadcrumb').removeClass('light-theme');
        Cookies.remove('theme');
    });
});

// smooth scroll
$(document).ready(function(){
    $(".navbar .nav-link").on('click', function(event) {

        if (this.hash !== "") {

            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 700, function(){
                window.location.hash = hash;
            });
        }
    });
});

// Marketplace filter
$('#filter-button').on('click', function () {
    $('#filter-form').slideToggle('400', 'swing', function(){
        if ($('#filter-form').is(':visible')) {
            $('#filter-button').addClass('active');
        } else {
            $('#filter-button').removeClass('active');
        }
    })

});

if ($('#title-filter').val() || $('#price-from-filter').val() || $('#price-to-filter').val()) {
    $('#filter-button').addClass('active');
    $('#filter-form').show();
}
