<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/19/18
 * Time: 12:27 PM
 */

namespace Enigma;


class Sender
{

    public function addRecipients($userid){
        $this->recipients[$userid] = $userid;

    }
    public function removeRecipient($userid){
        unset($this->recipients[$userid]);
    }

    public function getRecipients(){
        return $this->recipients;
    }
    public function getCode(){
        return $this->code;
    }
    public function clearCode(){
        $this->code = '';
    }
    public function setCode($code){
        if(strlen($code) == 3 and ctype_alpha($code)){
            $this->code = strtoupper($code);
            return true;
        }
        return false;
    }
    public function getMessage(){
        return $this->message;
    }
    public function setMessage($message){
        $this->message = $message;
    }
    public function getSenderID(){
        return $this->senderID;
    }
    public function setSenderID($id){
        $this->senderID = $id;
    }
    public function clearRecipients(){
        $this->recipients = array();
    }

    private $recipients = array();
    private $code = '';
    private $message = '';
    private $senderID;

}