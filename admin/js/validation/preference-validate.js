/**
 * Created by RAYMARTHINKPAD on 2017-08-23.
 */
let PasswordMatchValidate = (function () {
  let fields = {
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