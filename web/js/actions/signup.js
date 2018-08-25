/**
 * Show password action
 */
app.register('showPassword', function() {
    $('[data-action="show-password"]').click(function () {
        if ($('#password').attr('type') === 'password') {
            $('#password').attr('type', 'text');
            $('#toggle-password').html('<span class="fa fa-fw fa-eye-slash" aria-hidden="true"></span>\n' +
                '<span class="offscreen">Hide password</span>');
        } else {
            $('#password').attr('type', 'password');
            $('#toggle-password').html('<span class="fa fa-fw fa-eye" aria-hidden="true"></span>\n' +
                '<span class="offscreen">Show password</span>');
        }
    });
});

/**
 * Validate form action
 */
app.register('validateForm', function() {
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
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo( element.parent() );
        }
    });
});

app.run('showPassword').run('validateForm');