/**
 * Created by RAYMARTHINKPAD on 2017-08-23.
 */
let LoginValidate = (function () {
  let fields = {
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