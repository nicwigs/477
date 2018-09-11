<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/7/18
 * Time: 9:09 PM
 */

namespace Enigma;

use Enigma\System as System;
use Enigma\Cell as Cell;

class EnigmaView extends View
{
    public function __construct(\Enigma\System $system, $user)
    {
        parent::__construct($system);
        $this->user = $user;
    }

    public function present_body(){

        $html = '<h1 class="center">Greetings, ';
        $html .= $this->user->getName();
        $html .= <<<HTML
, and welcome to The Endless Enigma!</h1><div class="body">
<form method="post" action="post/enigma-post.php">
HTML;
        $r1 = $this->system->getEnigma()->getRotorSetting(1);
        $r2 = $this->system->getEnigma()->getRotorSetting(2);
        $r3 = $this->system->getEnigma()->getRotorSetting(3);

        $html .= <<<HTML
<div class="enigma" id="enigma">
<figure class="enigma"><img src="images/enigma.png" alt="Enigma Simulation"></figure>
<p class="wheel wheel-1">$r1</p>
<p class="wheel wheel-2">$r2</p>
<p class="wheel wheel-3">$r3</p>
HTML;

        $cells = $this->system->getCells();
        foreach($cells as $key => $cell){
            $letter = $cell->getLetter();
            $lowercase = lcfirst($letter);
            $pressed = $cell->isPressed() ? 'pressed ' : '';
            $lit = $cell->isLit() ? 'light-on ' : '';

            $html .= <<<HTML
<div class="key key-$lowercase $pressed"><img src="images/key.png" alt="$letter Key"><button name="key" value="$letter"><span>$letter</span></button></div>
<div class="light light-$lowercase $lit">$letter</div>
HTML;
        }

        $html .= <<<HTML
</div></form>
<form class="dialog" method="post" action="post/enigma-post.php">
<p><input type="submit" name="reset" value="Reset"></p>
</form>

</div>
HTML;


        return $html;

    }
    private $user;


}