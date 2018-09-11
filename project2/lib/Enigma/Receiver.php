<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/20/18
 * Time: 3:05 PM
 */

namespace Enigma;


class Receiver
{

    public function getMessage(){
        return $this->message;
    }
    public function setMessage($msg){
        $this->message = $msg;
    }
    public function getCode(){
        return $this->code;
    }
    public function setCode($code){
        $this->code = $code;
    }
    public function getID(){
        return $this->receiverID;
    }
    public function setID($id){
        $this->receiverID = $id;
    }
    public function getMessageID(){
        return $this->messageID;
    }
    public function setMessageID($id){
        $this->messageID = $id;
    }


    private $message = '';
    private $code = '';
    private $receiverID;
    private $messageID;


}