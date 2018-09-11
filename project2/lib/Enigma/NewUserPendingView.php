<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/16/18
 * Time: 12:17 PM
 */

namespace Enigma;


class NewUserPendingView extends View
{

    public function present_body(){
        $html = <<<HTML
<p></p>
<form class="newgame" method="get" action="post/newuserpending.php">
    <div class="controls dialog">
        <p>An email message has been sent to your address. When it arrives, select the
        validate link in the email to validate your account.</p>
        <p><button>Home</button></p>
    </div>
</form>
<p></p>
HTML;

        return $html;
    }
}