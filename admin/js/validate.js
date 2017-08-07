/**
 * Created by RAYMARTHINKPAD on 2017-08-05.
 * All self-running validate function here.
 * Usage example:
 *  in form tag use
 *  onSubmit='RegisterValidate.validateForm()';
 */

/**
 * Returns true if all is good okay.
 * @type {{validateForm}}
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