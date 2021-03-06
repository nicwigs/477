<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/8/18
 * Time: 3:52 AM
 */

namespace Enigma;


class BatchView extends View
{
    public function present_header(){
        $html = <<<HTML
<header>
<figure><img src="images/banner-800.png" width="800" height="357" alt="Header image"/></figure><nav><ul><li><a href="enigma.php">Enigma</a></li><li><a href="settings.php">Settings</a></li><li class="selected"><a href="batch.php">Batch</a></li><li><a href="./">Ausloggen</a></li></ul></nav>
</header>
HTML;
        return $html;
    }
    public function present_body(){

        $rs1 = $this->system->getEnigma()->getRotorSetting(1);
        $rs2 = $this->system->getEnigma()->getRotorSetting(2);
        $rs3 = $this->system->getEnigma()->getRotorSetting(3);

        $to = $this->system->getEncoded();
        $from = $this->system->getDecoded();

        $html = <<<HTML
<div class="body">
<div class="enigma" id="enigma">
<figure class="enigma"><img src="images/rotors.png" alt="Enigma Rotors" width="1024" height="580"></figure>
<p class="wheel wheel-s wheel-1">$rs1</p>
<p class="wheel wheel-s wheel-2">$rs2</p>
<p class="wheel wheel-s wheel-3">$rs3</p>
</div>
<form class="dialog" method="post" action="post/batch-post.php">
<div class="encoder">
HTML;
        $html .='<p><textarea name="from">';
        $html .= $from ;
        $html .= '</textarea> <textarea name="to">';
        $html .= $to ;
        $html .= <<<HTML
</textarea></p>
<p><input type="submit" name="encode" value="Encode ->"> 
<input type="submit" name="decode" value="Decode <-"> <input type="submit" name="reset" value="Reset"></p>
</div>
</form>
</div>
HTML;
        return $html;

    }

}