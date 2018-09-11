<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/6/18
 * Time: 10:28 PM
 */

namespace Enigma;

use Enigma\System as System;

class IndexView extends View
{
    public function present_header($tab = 0){
        return parent::present_header(View::TAB_ENIGMA);
    }
    public function __construct($system,$session, $get)
    {
        parent::__construct($system);

        $this->session = $session;
        $this->get = $get;
    }

    public function present_body(){
        $html = <<<HTML
<h1 class="center">Welcome to Nic Wiggins's Endless Enigma!</h1><div class="body">
<form class="dialog" method="post" action="post/login.php">
	<div class="controls">
	<p class="name"><label for="name">Email </label><br><input type="email" id="name" name="name"></p>
	<p class="password"><label for="name">Password </label><br><input type="password" id="password" name="password"></p>
	<p><button name="ok">Login</button></p>
    <p><a href="./newuser.php">New User</a></p>
HTML;
        if(isset($this->get['e'])){
            $error = $this->session[LoginController::ERROR];
            $html .= '<p class="msg">';
            $html .= $error;
            $html .='</p>';
        }
        $html .= <<<HTML
	</div>
</form>
</div>
HTML;
        $this->system->clear();

        return $html;
    }

    private $session = null;
    private $get = null;

}