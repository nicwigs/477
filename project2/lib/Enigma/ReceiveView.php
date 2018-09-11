<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/8/18
 * Time: 12:27 AM
 */

namespace Enigma;


class ReceiveView extends View
{
    public function __construct(\Enigma\System $system, $site, $get,$user)
    {
        parent::__construct($system);
        $this->site = $site;
        $this->get = $get;
        $this->userid = $user->getID();
    }

    public function present_header($tab = 0){
        return parent::present_header(View::TAB_RECIEVE);
    }
    public function present_body(){

        $html = <<<HTML
<div class="body receiver">
    <form method="post" action="post/receiver.php">
HTML;
        $html .= parent::present_settings();


        $receivers = new Receivers($this->site);
        $msgs = $receivers->fetchMessages($this->userid);


        if(isset($this->get['s'])){ //someone is selected
            $code = $this->system->getReceiver()->getCode();
            $to = $this->system->getEncoded();
            $from = $this->system->getDecoded();

            $html .= <<<HTML
            <div class="dialog decode">
            <p class="code">Code: $code</p>
            <div><div class="dec">$from</div> <div class="enc">$to</div></div>
        </div>
HTML;

        }
        $html .= <<<HTML
        <div class="dialog messages">
            <table>
                <tbody>
                <tr><th>Select</th><th>Time</th><th>Sender</th></tr>
HTML;


        foreach($msgs as $row){
            $date = $row['date'];
            $date = date('F d \, Y h:i a',strtotime($date));
            $sender = $row['name'];
            $value = $row['id'];
            if($value == $this->system->getReceiver()->getMessageID()){
                $checked = 'checked';
            }else{
                $checked = '';
            }
            $html .= <<<HTML
                <tr><td><input value="$value" type="radio" name="message" $checked></td><td>$date</td><td>$sender</td></tr>
HTML;

        }
        $html .= <<<HTML
                </tbody>
            </table>
            <p><input type="submit" value="View"></p></div></form></div>
HTML;

        return $html;

    }
    private $site;
    private $get;
    private $userid;
}