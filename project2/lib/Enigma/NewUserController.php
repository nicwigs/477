<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/17/18
 * Time: 12:22 AM
 */

namespace Enigma;


class NewUserController
{

    /**
     * UsersController constructor.
     * @param Site $site Site object
     * @param User $user Current user
     * @param array $post $_POST
     */
    public function __construct(Site $site, array &$session, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/newuserpending.php";

        if(isset($post['cancel'])){
            $this->redirect = "$root/index.php";
            return;
        }
        $email = strip_tags($post['email']);
        $name = strip_tags($post['name']);

        if((ctype_space($email) or empty($email))){
            $this->redirect = "$root/newuser.php?e";
            $session[self::ERROR] = self::NO_EMAIL;
            return;
        }
        if((ctype_space($name) or empty($name))){
            $this->redirect = "$root/newuser.php?e";
            $session[self::ERROR] = self::NO_NAME;
            return;
        }

        $users = new Users($site);

        if($users->exists($email)){
            $this->redirect = "$root/newuser.php?e";
            $session[self::ERROR] = self::EMAIL_ALREADY;
            return;
        }

        $mailer = new Email();
        $users->sendEmail($name,$email,$mailer);

    }

    /**
     * Get any redirect link
     * @return mixed Redirect link
     */
    public function getRedirect() {
        return $this->redirect;
    }

    const ERROR = 'error';
    const NO_EMAIL = 'You must enter an email';
    const NO_NAME = 'You must enter a name';
    const EMAIL_ALREADY = 'Email address already exists';

    private $redirect;	///< Page we will redirect the user to.
}