<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/7/18
 * Time: 6:39 PM
 */

namespace Enigma;


class Cell
{
    public function __construct($letter){
        $this->letter = $letter;
    }
    public function isPressed(){
        return $this->pressed;
    }
    public function isLit(){
        return $this->lit;
    }
    public function press(){
        $this->pressed = true;
    }
    public function unPress(){
        $this->pressed = false;
    }
    public function light(){
        $this->lit = true;
    }
    public function off(){
        $this->lit = false;
    }
    public function getLetter(){
        return $this->letter;
    }

    private $letter;
    private $pressed = false;
    private $lit = false;

}