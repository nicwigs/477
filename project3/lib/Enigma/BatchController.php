<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/8/18
 * Time: 2:44 AM
 */

namespace Enigma;

use Enigma\System as System;

class BatchController extends Controller
{
    public function __construct(System $system, $post)
    {
        Controller::__construct($system);
        $this->redirect = './../batch.php';

        if (isset($post['encode'])) {
            $prepared = $this->prepare(strip_tags($post['from']));
            $system->encode($prepared);
            $system->setFrom(strip_tags($post['from'])); //left box keeps message u are coding

        }elseif (isset($post['decode'])) {
            $prepared = str_replace(" ", "", strip_tags($post['to']));
            $system->decode($prepared);
            $system->setTo(strip_tags($post['to'])); //right side box keeps message u are decoding

        }elseif (isset($post['reset'])){
            $system->reset();
        }
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
}
