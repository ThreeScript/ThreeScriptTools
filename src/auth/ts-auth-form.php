<?

/** ----------------------------------------------------------------------------
 * @param type $provider
 * @param type $nickname
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $provider_user_id
 * @return string
 * -----------------------------------------------------------------------------
 */
function formCommonBS($title, $content) {
   $str = "
      <h1 class='well' style='position: absolute; margin-top: 0px;'>" . _($title) . "</h1>
      <div class='col-lg-12 well' style='position: absolute; top: 100px;'>
         <form id='id-form-auth' action='?' method='post' role='form'>
            <div class='col-sm-12'>
            $content
            </div >
         </form>
      </div >";
   return $str;
}

/** ----------------------------------------------------------------------------
 * @param type $provider
 * @param type $nickname
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $provider_user_id
 * @return string
 * -----------------------------------------------------------------------------
 */
function formSigninBS() {
   $auth = "<input type='hidden' name='auth'>";
   $operation = "<input id='operation' type='hidden' name='operation' value=''>";
   $nickname = formRowFieldBS(_("Nickname or email"), "text", "nickname_or_email", "nickname_or_email", "", "form-group", "glyphicon-user", _("Type your nickname."), _("Use at least four alphanumeric characters, without spaces and the first alfa."));
   $password = formRowFieldBS(_("Password"), "password", "password", "password", "", "form-group", "glyphicon-lock", _("Type your nickname."), _("Use at least four alphanumeric characters, without spaces and the first alfa."));

   $buttons = providersButtons();

   $content = "
      $auth
      $operation
      $nickname
      $password
      <a id='btn-signin' href='#' class='btn btn-primary'>" . _("Sign In") . "</a>
      <a id='btn-register' href='#' class='btn btn-primary'>" . _("Register") . "</a>
      <a id='btn-change-password' href='#' class='btn btn-primary'>" . _("Change Password") . "</a>
      <a id='btn-edit' href='?edit' class='btn btn-primary'>" . _("TS Editor") . "</a>
      <a id='btn-home' href='?' class='btn btn-primary'>" . _("Home") . "</a>
      $buttons
   ";

   $str = formCommonBS("Sign In", $content);
   return $str;
}

/** ----------------------------------------------------------------------------
 * @param type $provider
 * @param type $nickname
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $provider_user_id
 * @return string
 * -----------------------------------------------------------------------------
 */
function formChangePasswordBS($from_link) {
   $auth = "<input type='hidden' name='auth'>";
   $operation = "<input id='operation' type='hidden' name='operation' value=''>";
   if ($from_link) {
      
   } else {
      $password_now = formRowFieldBS(_("Password"), "password", "password", "password", "", "form-group", "glyphicon-lock", _("Type your password."), _("Type your actual password."));
   }
   $password_new = formRowFieldBS(_("New Password"), "password", "password1", "password1", "", "form-group", "glyphicon-lock", _("Type the new password."), _("Use at least four alphanumeric characters, without spaces and the first alfa."));
   $password_new_retyped = formRowFieldBS(_("Retype New Password"), "password", "password2", "password2", "", "form-group", "glyphicon-lock", _("Retype the new password."), _("Use at least four alphanumeric characters, without spaces and the first alfa."));
   $buttons = providersButtons();
   $content = "
      $auth $operation $password_now $password_new $password_new_retyped
      <a id='btn-email-change-key' href='#' class='btn btn-primary'>" . _("Confirm Change") . "</a>
      <a id='btn-edit' href='?edit' class='btn btn-primary'>" . _("TS Editor") . "</a>
      <a id='btn-home' href='?' class='btn btn-primary'>" . _("Home") . "</a>
      $buttons
   ";
   $str = formCommonBS("Change Password", $content);
   return $str;
}

/** ----------------------------------------------------------------------------
 * @param type $provider
 * @param type $nickname
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $provider_user_id
 * @return string
 * -----------------------------------------------------------------------------
 */
function formSendEmailChangePasswordBS() {
   $auth = "<input type='hidden' name='auth'>";
   $operation = "<input id='operation' type='hidden' name='operation' value=''>";
   $email = formRowFieldBS(_("Email"), "text", "email", "email", "", "form-group", "glyphicon-envelope", _("Type your email."), _("Type your valid email address to receive a link to change your password."));
   $buttons = providersButtons();
   $content = "
      $auth
      $operation
      $email
      <a id='btn-send-email-change-password' href='#' class='btn btn-primary'>" . _("Send Email") . "</a>
      <a id='btn-signin' href='#' class='btn btn-primary'>" . _("Sign In") . "</a>
      <a id='btn-register' href='#' class='btn btn-primary'>" . _("Register") . "</a>
      <a id='btn-edit' href='?edit' class='btn btn-primary'>" . _("TS Editor") . "</a>
      <a id='btn-home' href='?' class='btn btn-primary'>" . _("Home") . "</a>
      $buttons
   ";
   $str = formCommonBS("Change Password with Email", $content);
   return $str;
}

/** ----------------------------------------------------------------------------
 * @param type $provider
 * @param type $nickname
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $provider_user_id
 * @return string
 * -----------------------------------------------------------------------------
 */
function formRegisterBS($provider, $nickname, $firstname, $lastname, $email, $provider_user_id) {
   $auth = "<input type='hidden' name='auth'>";
   $operation = "<input id='operation' type='hidden' name='operation' value=''>";
   $nickname = formRowFieldBS(_("Nickname"), "text", "nickname", "nickname", "", "form-group", "glyphicon-user", _("Type your nickname."), _("Use at least four alphanumeric characters, without spaces and the first alfa."));
   $firstname = formRowFieldBS(_("First Name"), "text", "firstname", "firstname", $firstname, "col-sm-6 form-group", null, _("Type your first name."), _("Use at least two alphabetic characters."));
   $lastname = formRowFieldBS(_("Last Name"), "text", "lastname", "lastname", $lastname, "col-sm-6 form-group", null, _("Type your last name"), _("Use at least two alphabetic characters."));
   $email = formRowFieldBS(_("Email"), "text", "email", "email", $email, "col-sm-6 form-group", "glyphicon-envelope", _("Type your email."), _("Valid email."));
   if ($provider)
      $email2 = "";
   else
      $email2 = formRowFieldBS(_("Retype Email"), "text", "email2", "email2", "", "col-sm-6 form-group", null, _("Retype your email."), _("Retype the valid email."));
   $password = formRowFieldBS(_("Password"), "password", "password", "password", "", "col-sm-6 form-group", "glyphicon-lock", _("Type your password"), _("Use at least one uppercase letter, one lowercase letter, one number and one non-alphanumeric character."));
   $password2 = formRowFieldBS(_("Retype Password"), "password", "password2", "password2", "", "col-sm-6 form-group", null, _("Retype your password."), _("Retype the password the same as the previous one."));

   $buttons = providersButtons();

   $content = "
      $auth
      $operation
      $nickname
      <div class='row'>
         $firstname
         $lastname
      </div>
      <div class='row'>
         $email
         $email2
      </div>
      <div class='row'>
         $password
         $password2
      </div>
      <a id='btn-save-register' href='#' class='btn btn-primary'>" . _("Save Register") . "</a>
      <a id='btn-signin' href='#' class='btn btn-primary'>" . _("Sign In") . "</a>
      <a id='btn-change-password' href='#' class='btn btn-primary'>" . _("Change Password") . "</a>
      <a id='btn-edit' href='?edit' class='btn btn-primary'>" . _("TS Editor") . "</a>
      <a id='btn-home' href='?' class='btn btn-primary'>" . _("Home") . "</a>
      $buttons
   ";

   $str = formCommonBS("Register", $content);

   return $str;
}

/** ----------------------------------------------------------------------------
 * @param type $provider
 * @param type $nickname
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $provider_user_id
 * @return string
 * -----------------------------------------------------------------------------
 */
function formConfirmBS() {
   $auth = "<input type='hidden' name='auth'>";
   $operation = "<input id='operation' type='hidden' name='operation' value=''>";
   $confirm_key = formRowFieldBS(_("Confirm Key"), "text", "confirm_key", "confirm_key", "", "form-group", "glyphicon-user", _("Type your nickname."), _("Use at least four alphanumeric characters, without spaces and the first alfa."));
   $buttons = providersButtons();
   $content = "
      $auth
      $operation
      $confirm_key
      <a id='btn-signin' href='#' class='btn btn-primary'>" . _("Sign In") . "</a>
      <a id='btn-email-register-key' href='#' class='btn btn-primary'>" . _("Confirm Key") . "</a>
      <a id='btn-edit' href='?edit' class='btn btn-primary'>" . _("TS Editor") . "</a>
      <a id='btn-home' href='?' class='btn btn-primary'>" . _("Home") . "</a>
      $buttons
   ";
   $str = formCommonBS("Confirm", $content);
   return $str;
}

/** ----------------------------------------------------------------------------
 * @param type $provider
 * @param type $nickname
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $provider_user_id
 * @return string
 * -----------------------------------------------------------------------------
 */
function formConfirmedBS() {
   $auth = "<input type='hidden' name='auth'>";
   $operation = "<input id='operation' type='hidden' name='operation' value=''>";
   $buttons = providersButtons();
   $content = "
      $auth
      $operation
      <a id='btn-signin' href='#' class='btn btn-primary'>" . _("Sign In") . "</a>
      <a id='btn-edit' href='?edit' class='btn btn-primary'>" . _("TS Editor") . "</a>
      <a id='btn-home' href='?' class='btn btn-primary'>" . _("Home") . "</a>
      $buttons
   ";
   $str = formCommonBS("Confirmed", $content);
   return $str;
}

/** ----------------------------------------------------------------------------
 * @param type $provider
 * @param type $nickname
 * @param type $firstname
 * @param type $lastname
 * @param type $email
 * @param type $provider_user_id
 * @return string
 * -----------------------------------------------------------------------------
 */
function formNotConfirmedBS($nickname, $email) {
   $auth = "<input type='hidden' name='auth'>";
   $operation = "<input id='operation' type='hidden' name='operation' value=''>";
   $nickname_hidden = "<input id='nickname' type='hidden' name='nickname' value='$nickname'>";
   $email_hidden = "<input id='email' type='hidden' name='email' value='$email'>";
   $confirm_key = formRowFieldBS(_("Confirm key"), "text", "confirm_key", "confirm_key", "", "form-group", "glyphicon-user", _("Type your nickname."), _("Use at least four alphanumeric characters, without spaces and the first alfa."));
   $buttons = providersButtons();
   $content = "
      $auth
      $operation
      $nickname_hidden
      $email_hidden
      $confirm_key
      <a id='btn-send-again-email-confirm-register' href='#' class='btn btn-primary'>" . _("Send Email") . "</a>
      <a id='btn-confirm-register-key' href='#' class='btn btn-primary'>" . _("Confirm Key") . "</a>
      <a id='btn-signin' href='#' class='btn btn-primary'>" . _("Sign In") . "</a>
      <a id='btn-edit' href='?edit' class='btn btn-primary'>" . _("TS Editor") . "</a>
      <a id='btn-home' href='?' class='btn btn-primary'>" . _("Home") . "</a>
      $buttons
   ";
   $str = formCommonBS("Not Confirmed", $content);
   return $str;
}

?>
