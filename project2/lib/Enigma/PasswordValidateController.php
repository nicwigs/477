<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/17/18
 * Time: 1:18 AM
 */

namespace Enigma;


class PasswordValidateController
{

    /**
     * PasswordValidateController constructor.
     * @param Site $site The Site object
     * @param array $post $_POST
     */
    public function __construct(Site $site, array &$session, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/";

        if(isset($post['cancel'])){
            return;
        }

        //
        // 1. Ensure the validator is correct! Use it to get the email
        //
        $validators = new Validators($site);
        $validator = strip_tags($post['validator']);
        $row = $validators->get($validator);
        $email = $row['email'];
        $name = $row['name'];
        if($email === null) {
            $this->redirect = "$root/password-validate.php?v=$validator&e";
            $session[self::ERROR] = self::INVALID_VALIDATOR;
            return;
        }
        //
        // 2. Ensure the email matches the user.
        //
        $emailEntered = trim(strip_tags($post['email']));
        if($emailEntered !== $email) {
            // Email entered is invalid
            $this->redirect = "$root/password-validate.php?v=$validator&e";
            $session[self::ERROR] = self::EMAIL_NOT_MATCH;
            return;
        }

        //
        // 3. Ensure the passwords match each other
        //
        $password1 = trim(strip_tags($post['password']));
        $password2 = trim(strip_tags($post['password2']));
        if($password1 !== $password2) {
            // Passwords do not match
            $this->redirect = "$root/password-validate.php?v=$validator&e";
            $session[self::ERROR] = self::PASSWORD_NOT_MATCH;
            return;
        }

        if(strlen($password1) < 8) {
            // Password too short
            $this->redirect = "$root/password-validate.php?v=$validator&e";
            $session[self::ERROR] = self::PASSWORD_SHORT;
            return;
        }

        //
        // 3.5 Create the user
        //
        $id = 0; //Just need this for user constructor, table will create an actual ID
        $users = new Users($site);
        $row = array('id' => $id,'email' => $email, 'name' => $name);
        $user = new User($row);
        if($users->add($user) == self::EMAIL_ALREADY_EXISTS){
            $this->redirect = "$root/password-validate.php?v=$validator&e";
            $session[self::ERROR] = self::EMAIL_ALREADY_EXISTS;
            return;
        }


        //
        // 4. Create a salted password and save it for the user.
        //
        // concened this will grab non updated value
        //$userid = $user->getId();
        $users->setPasswordViaEmail($email, $password1);

        //
        // 5. Destroy the validator record so it can't be used again!
        //
        $validators->remove($email);
    }

    /**
     * Get any redirect link
     * @return mixed Redirect link
     */
    public function getRedirect() {
        return $this->redirect;
    }

    const ERROR = 'error';
    const INVALID_VALIDATOR = 'Invalid or unavailable validator';
    const EMAIL_NOT_MATCH = 'Email address does not match validator';
    const EMAIL_ALREADY_EXISTS = "Email address already exists.";
    const PASSWORD_NOT_MATCH = 'Passwords did not match';
    const PASSWORD_SHORT = 'Password too short';

    private $redirect;	///< Page we will redirect the user to.
}