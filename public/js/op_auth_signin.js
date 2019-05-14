/*
 *  Document   : op_auth_signin.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Sign In Page
 */

var OpAuthSignIn = function() {
    // Init Sign In Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
    var initValidationSignIn = function(){
        // var aaa = "qwerty";
        // var bbb = "asdfghjkl";
        jQuery('.js-validation-signin').validate({
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
            },
            rules: {
                'loginUsername': {
                    required: true,
                    minlength: 3,
                },
                'loginPassword': {
                    required: true,
                    minlength: 5,
                }
            },
            messages: {
                'loginUsername': {
                    required: 'Masukkan Username',
                    minlength: 'Username Minimal 3 Karakter',
                    equalTo: 'Username Tidak Sesuai'
                },
                'loginPassword': {
                    required: 'Masukkan Password',
                    minlength: 'Password Minimal 5 Karakter',
                    equalTo: 'Password Tidak Sesuai'
                }
            }
        });
    };

    return {
        init: function () {
            // Init Sign In Form Validation
            initValidationSignIn();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ OpAuthSignIn.init(); });