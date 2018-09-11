<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/6/18
 * Time: 9:50 PM
 */

namespace Enigma;

use Enigma\System as System;

class View
{
    public function __construct(System $system){
        $this->system = $system;

    }

    public function getSystem(){
        return $this->system;
    }

    public function present_header($tab = 0){
        $selected = array('','','','','','');
        $selected[$tab] = 'class="selected"';

        $html = <<<HTML
<header>
    <figure><img src="images/banner-800.png" width="800" height="357" alt="Header image"></figure><nav><ul><li $selected[0]><a href="enigma.php">Enigma</a></li><li $selected[1]><a href="settings.php">Settings</a></li><li $selected[2]><a href="batch.php">Batch</a></li><li $selected[3]><a href="sender.php">Send</a></li><li $selected[4]><a href="receiver.php">Receive</a></li><li><a href="./post/logout.php">Ausloggen</a></li></ul></nav>
</header>
HTML;
        return $html;
    }

    public function present_footer(){
        $html = <<<HTML
<footer>
	<p class="center"><img src="images/banner1-800.png" width="800" height="100" alt="Footer image"/></p>
</footer>
HTML;
        return $html;
    }

    public function present_body(){
        return '';
    }

    public function present() {
        return $this->present_header() .
            $this->present_body() .
            $this->present_footer();
    }

    public function head(){
        $html = <<<HTML
<link href="lib/css/enigma.css" type="text/css" rel="stylesheet" />
HTML;
        return $html;

    }

    public function present_settings(){

        $rs1 = $this->system->getEnigma()->getRotorSetting(1);
        $rs2 = $this->system->getEnigma()->getRotorSetting(2);
        $rs3 = $this->system->getEnigma()->getRotorSetting(3);
        $rs = array(1=>$rs1,2=>$rs2,3=>$rs3);
        $r1 = $this->system->getEnigma()->getRotor(1);
        $r2 = $this->system->getEnigma()->getRotor(2);
        $r3 = $this->system->getEnigma()->getRotor(3);
        $r = array(1=>$r1,2=>$r2,3=>$r3);
        $error = $this->system->getSettingsErrors();


        $html = <<<HTML
        <div class="dialog">
HTML;

        for($i=1;$i<=3;$i++){
            $html .= <<<HTML
<p><label for="rotor-$i">Rotor $i:</label>
<select id="rotor-$i" name="rotor-$i">
HTML;
            for ($j=1;$j<=5;$j++){
                $selected = $r[$i] == $j ? ' selected' : '';
                $numeral = $this->rn[$j];
                $html .= <<<HTML
<option value="$j" $selected>$numeral</option>
HTML;
            }
            $html .= <<<HTML
</select>&nbsp;&nbsp;
<label for="initial-$i">Setting:</label>
<input class="initial" id="initial-$i" name="initial-$i" type="text" value="$rs[$i]">
</p>  
HTML;

        }
        $html .= '<p>'.$error.'</p>';
        $html .='<p><input type="submit" name="set" value="Set"> <input type="submit" name="cancel" value="Cancel"></p></div>';


        return $html;

    }
    const TAB_ENIGMA = 0;
    const TAB_SETTINGS = 1;
    const TAB_BATCH = 2;
    const TAB_SEND = 3;
    const TAB_RECIEVE = 4;
    const TAB_RECIPIENTS = 5;

    private $rn = array(1=>"I",2=>"II",3=>"III",4=>"IV",5=>"V");
    protected $system; ///System of the view
}