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

    public function prepare($msg){
        $encoded = str_replace(".","X",$msg);
        $encoded = str_replace(" ","",$encoded);
        $encoded = str_replace("1","EINZ",$encoded);
        $encoded = str_replace("2","ZWO",$encoded);
        $encoded = str_replace("3","DREI",$encoded);
        $encoded = str_replace("4","VIER",$encoded);
        $encoded = str_replace("5","FUNF",$encoded);
        $encoded = str_replace("6","SEQS",$encoded);
        $encoded = str_replace("7","SIEBEN",$encoded);
        $encoded = str_replace("8","AOT",$encoded);
        $encoded = str_replace("9","NEUN",$encoded);
        $encoded = str_replace("0","NULL",$encoded);

        $encoded = preg_replace("/[^a-zA-Z]/","",$encoded);
        $encoded = strtoupper($encoded);

        return $encoded;


    }

    protected $redirect;
    private $system;
}