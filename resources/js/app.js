import './bootstrap';

$('select[id="country"], select[id="state"], select[id="lga"], select[id="s_accredit"], select[id="s_location"], select[id="u_gender"], select[id="u_position"]').on('change', function () {
    $('option', this).eq(0).attr('disabled', 'disabled')
});

// Scroll to Top
$('div.h-screen').on('scroll', () => {
    if (window.outerHeight > 693) {
        if (document.querySelector('div.h-screen').scrollTop > 1500) {
            $('a[href="#home"]').removeClass('hidden');
        } else {
            $('a[href="#home"]').addClass('hidden');
        }
    }

    if (window.outerHeight <= 693) {
        if (document.querySelector('div.h-screen').scrollTop > 750) {
            $('a[href="#home"]').removeClass('hidden');
        } else {
            $('a[href="#home"]').addClass('hidden');
        }
    }
});