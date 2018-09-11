<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/6/18
 * Time: 11:15 PM
 */

namespace Enigma;
use Enigma\System as System;

class Controller
{
    public function __construct(System $system){
        $this->system = $system;
    }
    public function getRedirect(){
        return $this->redirect;
    }

    /**
     * Debug option to display the redirect page instead of redirecting to it.
     * @return string HTML
     */
    public function showRedirect() {
        return "<p><a href=\"$this->redirect\">$this->redirect</a>";
    }

    protected $redirect;
    private $system;
}