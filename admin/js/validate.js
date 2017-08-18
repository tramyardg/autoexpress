var util = new CommonUtil();

var RegisterValidate = (function () {
    var fields = {
        email: {selector: null},
        username: {selector: null},
        password: {selector: null},
        confirmPassword: {selector: null}
    };
    return {
        validateForm: function () {
            fields.email.selector = $('#email');
            fields.username.selector = $('#username');
            fields.password.selector = $('#password');
            fields.confirmPassword.selector = $('#password_confirm');
            if (util.isEmpty(fields.username.selector.val())) {
                fields.username.selector.parent().parent().parent().addClass('has-warning');
                return false;
            } else if (util.isEmpty(fields.email.selector.val())) {
                fields.email.selector.parent().parent().parent().addClass('has-warning');
                return false;
            } else if (util.isEmpty(fields.password.selector.val())) {
                fields.password.selector.parent().parent().parent().addClass('has-warning');
                return false;
            } else if (util.isEmpty(fields.confirmPassword.selector.val())) {
                fields.confirmPassword.selector.parent().parent().parent().addClass('has-warning');
                return false;
            } else if (fields.confirmPassword.selector.val() !== fields.password.selector.val()) {
                fields.confirmPassword.selector.parent().parent().parent().addClass('has-warning');
                return false;
            }

            return true;
        }
    }; // end return
})();


/**
 * Returns true if all fields are good (filled with correct value)
 * @type {{validateForm}}
 */
var LoginValidate = (function () {
    var fields = {
        username: {selector: null},
        password: {selector: null}
    };
    return {
        validateForm: function () {
            fields.username.selector = $('#username');
            fields.password.selector = $('#password');
            if (util.isEmpty(fields.username.selector.val())) {
                fields.username.selector.parent().parent().parent().addClass('has-warning');
                return false;
            } else if (util.isEmpty(fields.password.selector.val())) {
                fields.password.selector.parent().parent().parent().addClass('has-warning');
                return false;
            }
            return true;
        }
    }; // end return
})();

//validate in preference page admin module for password
var PasswordMatchValidate = (function () {
    var fields = {
        password_1: {selector: null},
        password_2: {selector: null}
    };
    return {
        validateForm: function () {
            fields.password_1.selector = $('#password_1');
            fields.password_2.selector = $('#password_2');
            if (util.isEmpty(fields.password_1.selector.val())) {
                fields.password_1.selector.parent().parent().addClass('has-warning');
                return false;
            } else if (util.isEmpty(fields.password_2.selector.val())) {
                fields.password_2.selector.parent().parent().addClass('has-warning');
                return false;
            } else if (fields.password_1.selector.val() !== fields.password_2.selector.val()) {
                fields.password_2.selector.parent().parent().addClass('has-warning');
                return false;
            }
            return true;
        }
    };
})();