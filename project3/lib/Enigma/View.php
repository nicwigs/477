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

    public function present_header(){
        $html = <<<HTML
<header>
<figure><img src="images/banner-800.png" width="800" height="357" alt="Header image"/></figure><nav><ul><li class="selected"><a href="enigma.php">Enigma</a></li><li><a href="settings.php">Settings</a></li><li><a href="batch.php">Batch</a></li><li><a href="./">Ausloggen</a></li></ul></nav>
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
<link href="enigma.css" type="text/css" rel="stylesheet" />
HTML;
        return $html;

    }

    protected $system; ///System of the view
}