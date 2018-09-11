<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/8/18
 * Time: 12:27 AM
 */

namespace Enigma;


class SettingsView extends View
{
    public function present_header($tab = 0){
        return parent::present_header(View::TAB_SETTINGS);
    }
    public function present_body(){

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
<div class="body">
<div class="enigma" id="enigma">
<figure class="enigma"><img src="images/rotors.png" alt="Enigma Rotors" width="1024" height="580"></figure>
<p class="wheel wheel-s wheel-1">$rs1</p>
<p class="wheel wheel-s wheel-2">$rs2</p>
<p class="wheel wheel-s wheel-3">$rs3</p>
</div>
<form class="dialog" method="post" action="post/settings-post.php">
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

        $html .= <<<HTML
<p><input type="submit" name="set" value="Set"> <input type="submit" name="cancel" value="Cancel"></p>
<p>$error</p>
</form></div>
HTML;

        return $html;

    }
    private $rn = array(1=>"I",2=>"II",3=>"III",4=>"IV",5=>"V");
}