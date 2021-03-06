//== Class definition

var FormControls = function ($) {
    //== Private functions

    var demo1 = function ($) {
        $( "#m_form_add_update" ).validate({
            // define validation rules
            rules: {
                name_slug: {
                    required: true,
                    email: true ,
                },
                url_alias: {
                    required: true
                },
                user_password_first: {
                    required: true,
                },
                user_password_second: {
                    required: true,
                    equalTo: "#user_password_first"
                },
                phone: {
                    required: true,
                    phoneUS: true
                },
                option: {
                    required: true
                },
                options: {
                    required: true,
                    minlength: 2,
                    maxlength: 4
                },
                memo: {
                    required: true,
                    minlength: 10,
                    maxlength: 100
                },

                checkbox: {
                    required: true
                },
                checkboxes: {
                    required: true,
                    minlength: 1,
                    maxlength: 2
                },
                radio: {
                    required: true
                }
            },
            messages:{
                user_username: 'username không được để trống.',
                user_password_first: 'password không được để trống.',
                user_password_second:{
                    required: "Không được để trống",
                    equalTo: 'Mật khẩu phải giống nhau'
                },
                user_email: {
                    required: "Email không được để trống",
                    email: "email phải có dạng name@domain.com"
                },

            },

            //display error alert on form submit
            invalidHandler: function(event, validator) {
                var alert = $('#m_form_1_msg');
                alert.removeClass('m--hide').show();
                mApp.scrollTo(alert, -200);
            },

            submitHandler: function (form) {
                form[0].submit(); // submit the form
            }
        });
    }


    return {
        // public functions
        init: function($) {
            demo1($);
        }
    };
}();

jQuery(document).ready(function($) {
    FormControls.init($);
});
