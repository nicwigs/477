<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/6/18
 * Time: 10:28 PM
 */

namespace Enigma;

use Enigma\System as System;

class PasswordValidateView extends View
{
    public function __construct(\Enigma\System $system, $site, $get,$session)
    {
        parent::__construct($system);
        $this->get = $get;
        $this->site = $site;
        $this->validator = strip_tags($get['v']);
        $this->session = $session;
    }

    public function present_body(){
        $html = <<<HTML
<div class="body">
<form class="newgame" action="post/password-validate.php" method="post">
<div class="dialog">
<input type="hidden" name="validator" value="$this->validator">
<div class="controls">
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password">Password:</label><br>
			<input type="password" id="password" name="password" placeholder="password">
		</p>
		<p>
			<label for="password2">Password (again):</label><br>
			<input type="password" id="password2" name="password2" placeholder="password">
		</p>
		<p><button name="ok">Create Account</button></p>
	    <p><button name="cancel">Cancel</button></p>
HTML;
        if(isset($this->get['e'])){
            $error = $this->session[PasswordValidateController::ERROR];
            $html .= '<p class="msg">';
            $html .= $error;
            $html .='</p>';
        }
        $html .= <<<HTML
		</div>
		</div>
</form>
</div>
HTML;

        return $html;
    }

    private $site;
    private $get;
    private $validator;
    private $session;

}