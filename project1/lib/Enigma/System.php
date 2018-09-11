<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/6/18
 * Time: 9:21 PM
 */

namespace Enigma;

use Enigma\Enigma as Enigma;
use Enigma\Cell as Cell;

class System
{
    const NONAME = 0;
    const INVALID = 1;
    const VALID = 2;

    public function __construct(){
        $enigma = new Enigma();
        $this->enigma = $enigma;
        $this->populateCells();
    }
    public function check(){
        if($this->name === null){
            return self::NONAME;
        }elseif (ctype_space($this->name) or empty($this->name)){
            return self::INVALID;
        }else{
            return self::VALID;
        }
    }
    public function name($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function getEnigma(){
        return $this->enigma;
    }

    private function populateCells(){
        $this->cells['Q'] = new Cell('Q');
        $this->cells['W'] = new Cell('W');
        $this->cells['E'] = new Cell('E');
        $this->cells['R'] = new Cell('R');
        $this->cells['T'] = new Cell('T');
        $this->cells['Z'] = new Cell('Z');
        $this->cells['U'] = new Cell('U');
        $this->cells['I'] = new Cell('I');
        $this->cells['O'] = new Cell('O');
        $this->cells['A'] = new Cell('A');
        $this->cells['S'] = new Cell('S');
        $this->cells['D'] = new Cell('D');
        $this->cells['F'] = new Cell('F');
        $this->cells['G'] = new Cell('G');
        $this->cells['H'] = new Cell('H');
        $this->cells['J'] = new Cell('J');
        $this->cells['K'] = new Cell('K');
        $this->cells['P'] = new Cell('P');
        $this->cells['Y'] = new Cell('Y');
        $this->cells['X'] = new Cell('X');
        $this->cells['C'] = new Cell('C');
        $this->cells['V'] = new Cell('V');
        $this->cells['B'] = new Cell('B');
        $this->cells['M'] = new Cell('M');
        $this->cells['N'] = new Cell('N');
        $this->cells['L'] = new Cell('L');

    }
    public function getCells(){
        return $this->cells;
    }
    public function setActive($letter){
        $this->deactivate();

        $this->active = $letter;
        $this->lit = $this->enigma->pressed($letter);
        $this->cells[$this->active]->Press();
        $this->cells[$this->lit]->light();
    }
    public function getActive(){
        return $this->active;
    }
    public function isLit(){
        return $this->lit;
    }

    public function clear(){
        $this->enigma->clear();
        $this->name = null;
        $this->active = null;
        $this->lit = null;
        $this->deactivate();
        $this->encoded = '';
        $this->decoded = '';
    }

    public function reset(){
        foreach($this->rotorSettingsStored as $rotor => $letter){
            $this->enigma->setRotorSetting($rotor,$letter);
        }
        foreach($this->rotors as $rotor => $value){
            $this->enigma->setRotor($rotor,$value);
        }
        $this->deactivate();
    }

    public function deactivate(){
        if($this->active != null){
            $this->cells[$this->active]->unPress();
            $this->cells[$this->lit]->off();
        }
    }

    public function setSettingError($error){
        $this->settingsError = $error;
    }
    public function setRotorSettingsStored($rotor,$letter){
        $this->rotorSettingsStored[$rotor] = $letter;
        $this->enigma->setRotorSetting($rotor,$letter);
    }
    public function setRotors($rotor,$val){
        $this->rotors[$rotor] = $val;
        $this->enigma->setRotor($rotor,$val);
    }
    public function getSettingsErrors(){
        return $this->settingsError;
    }

    public function code($msg){
        $result = '';
        for($i=0; $i<strlen($msg); $i++) {
            $result .= $this->enigma->pressed(substr($msg, $i, 1));
        }
        return substr(chunk_split($result,5," "),0,-1);
    }
    public function encode($msg){
        $this->encoded = $this->code($msg);
    }
    public function getEncoded(){
        return $this->encoded;
    }
    public function decode($msg){
        $this->decoded = $this->code($msg);
    }
    public function getDecoded(){
        return $this->decoded;
    }
    public function setFrom($msg){
        return $this->decoded = $msg;
    }
    public function setTo($msg){
        return $this->encoded = $msg;
    }
    private $enigma; ///The enigma game we are playing
    private $name = null;
    private $cells = array();
    private $active = null;
    private $lit = null;
    private $rotorSettingsStored = array(1 =>'A',2 =>'A',3 =>'A');
    private $rotors = array(1 =>1,2 =>2,3 =>3);
    private $settingsError = '';
    private $encoded = '';
    private $decoded = '';
}