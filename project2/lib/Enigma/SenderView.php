<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/19/18
 * Time: 12:08 AM
 */

namespace Enigma;


class SenderView extends View
{
    public function __construct(\Enigma\System $system, $site)
{
    parent::__construct($system);
    $this->site = $site;
}

    public function present_header($tab = 0){
        return parent::present_header(View::TAB_SEND);
    }

    public function present_body(){
        if($this->system->getSender()->getCode() == ''){
            $this->system->clearMessages();
        }
        $to = $this->system->getEncoded();
        $from = $this->system->getDecoded();
        $code = $this->system->getSender()->getCode();

        $html = <<< HTML
<div class="body sender">
<form method="post" action="post/sender.php">
<div class="dialog receipients">
<p><label for="search">Find Recipients: </label><input type="search" name="search" id="search" placeholder="Search...">
<input type="submit" value="Search" name="searcher"></p>
HTML;
        if(empty($this->getSystem()->getSender()->getRecipients())){
            $html .= '<p>Use search to find recipients for a message to send.</p>';
        }else {
            $html .= '<table><tbody>';
            foreach($this->getSystem()->getSender()->getRecipients() as $recipient => $id){
                $users = new Users($this->site);
                $name = $users->get($id)->getName();
                $html .= <<<HTML
<tr><td><button name="remove" value="$id">Remove</button></td><td>$name</td></tr>
HTML;
            }
            $html .= '</tbody></table>';
        }

        $html .= '</div>';

        $html .= parent::present_settings();
        $html .= <<<HTML
<div class="dialog encode">
<p class="code"><label for="code">Code: </label><input type="text" name="code" id="code" value="$code"></p>
<div><textarea name="dec">$from</textarea> <div class="enc">$to</div></div>

<p><input type="submit" name="encode" value="Encode ->">
 <input type="submit" name="send" value="Send"></p>
</div></form></div>

HTML;

        return $html;
    }
    private $site;
}