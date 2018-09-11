<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/17/18
 * Time: 12:22 AM
 */

namespace Enigma;


class NewUserPendingController
{

    /**
     * UsersController constructor.
     * @param Site $site Site object
     * @param User $user Current user
     * @param array $post $_POST
     */
    public function __construct(Site $site) {
        $root = $site->getRoot();
        $this->redirect = "$root/index.php";
    }

    /**
     * Get any redirect link
     * @return mixed Redirect link
     */
    public function getRedirect() {
        return $this->redirect;
    }


    private $redirect;	///< Page we will redirect the user to.
}