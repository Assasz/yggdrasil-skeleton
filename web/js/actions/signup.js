/**
 * Toggle password action
 */
app.register('togglePassword', 'click', function() {
    const pass = $('#password');

    if (pass.attr('type') === 'password') {
        pass.attr('type', 'text');
        $(this).html('<span class="fa fa-fw fa-eye-slash" aria-hidden="true"></span>\n' +
            '<span class="offscreen">Hide password</span>');
    } else {
        pass.attr('type', 'password');
        $(this).html('<span class="fa fa-fw fa-eye" aria-hidden="true"></span>\n' +
            '<span class="offscreen">Show password</span>');
    }
}).run();

/**
 * Validate form action
 */
app.register('validateForm', 'no-event', function() {
    const normalizer = function(value) {
        return $.trim(value);
    };

    $("#signup_form").validate({
        rules: {
            email: {
                remote: {
                    url: 'emailcheck',
                    type: "post",
                    dataType: "json",
                    data: {
                        email: function () {
                            return $("#email").val();
                        }
                    },
                    dataFilter: function(data) {
                        let response = JSON.parse(data);
                        return (response === "true") ? true : "\"" + response + "\"";
                    }
                },
                required: true,
                email: true,
                normalizer: normalizer
            },
            username: {
                required: true,
                minlength: 2,
                maxlength: 36,
                normalizer: normalizer
            },
            password: {
                required: true,
                minlength: 6,
                normalizer: normalizer
            }
        },
        onkeyup: false,
        errorClass: "is-invalid",
        validClass: "is-valid",
        errorElement: "span",
        errorPlacement: function(error, element) {
            error.appendTo( element.parent() );
        }
    });
}).run();
