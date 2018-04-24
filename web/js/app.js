$(document).ready(function () {
    $(document).pjax('a:not([data-no-pjax])', '#pjax-container', {
        'timeout': 5000
    });

    $(document).on('submit', 'form[data-pjax]', function(event) {
        $.pjax.submit(event, '#pjax-container');
    });

    $(document).on('pjax:send', function () {
        NProgress.start();
    });

    $(document).on('pjax:end', function () {
        NProgress.done();
    });

    loadGlobalActions();
});

$(document).on('pjax:end', function () {
    loadGlobalActions();
});

function loadGlobalActions() {
    // globally accessible actions goes here
}