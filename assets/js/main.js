jQuery(document).ready(function($) {
    // Add smooth scroll class if enabled
    if (typeof flexpress_settings !== 'undefined' && flexpress_settings.smooth_scroll) {
        $('html').addClass('smooth-scroll');
    }

    // Mobile menu toggle (you can expand this)
    $('.menu-toggle').on('click', function() {
        $('.main-navigation').toggleClass('toggled');
    });

    // Add any custom JavaScript functionality here
});