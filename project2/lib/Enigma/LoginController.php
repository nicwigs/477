<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/11/18
 * Time: 7:38 PM
 */

namespace Enigma;


class LoginController
{

    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param array $session $_SESSION
     * @param array $post $_POST
     */
    public function __construct(Site $site, array &$session, array $post) {
        // Create a Users object to access the table
        $users = new Users($site);

        $email = strip_tags($post['name']);
        $password = strip_tags($post['password']);
        $user = $users->login($email, $password);
        $session[User::SESSION_NAME] = $user;


        $root = $site->getRoot();
        if($user === null) {
            // Login failed
            $this->redirect = "$root/index.php?e";
            $session[self::ERROR] = self::INVALID_LOGIN;
        } else {
            $this->redirect = "$root/enigma.php";
        }
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }


    private $redirect;	///< Page we will redirect the user to.
    const ERROR = 'error';
    const INVALID_LOGIN = 'Invalid login credentials';

}