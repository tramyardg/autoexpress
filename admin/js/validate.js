/**
 * Created by RAYMARTHINKPAD on 2017-08-05.
 */
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
            if (Util.isEmpty(fields.username.selector.val())) {
                fields.username.selector.parent().parent().parent().addClass('has-warning');
                return false;
            } else if (Util.isEmpty(fields.email.selector.val())) {
                fields.email.selector.parent().parent().parent().addClass('has-warning');
                return false;
            } else if (Util.isEmpty(fields.password.selector.val())) {
                fields.password.selector.parent().parent().parent().addClass('has-warning');
                return false;
            } else if (Util.isEmpty(fields.confirmPassword.selector.val())) {
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


var LoginValidate = (function () {
    var fields = {
        username: {selector: null},
        password: {selector: null}
    };
    return {
        validateForm: function () {
            fields.username.selector = $('#username');
            fields.password.selector = $('#password');
            if (Util.isEmpty(fields.username.selector.val())) {
                fields.username.selector.parent().parent().parent().addClass('has-warning');
                return false;
            } else if (Util.isEmpty(fields.password.selector.val())) {
                fields.password.selector.parent().parent().parent().addClass('has-warning');
                return false;
            }
            return true;
        }
    }; // end return
})();