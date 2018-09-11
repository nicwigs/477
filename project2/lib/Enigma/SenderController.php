<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/19/18
 * Time: 12:23 PM
 */

namespace Enigma;


class SenderController extends Controller
{

    public function __construct(\Enigma\System $system, $post, $site, $user)
    {
        parent::__construct($system);
        $this->redirect = "../sender.php";
        $system->getSender()->setSenderID($user->getID());


        if(isset($post['searcher'])){
            $search = trim(strip_tags($post['search']));
            if($search == ''){
                $this->redirect = "../sender.php";
            }else{
                $this->redirect = "../recipients.php?q=".$search;
            }
            return;
        }
        if(isset($post['remove'])){
            $this->redirect = "../sender.php";

            $id = trim(strip_tags($post['remove']));
            if($id == ''){
                return;
            }else{
                $system->getSender()->removeRecipient($id);
            }
        }
        if(isset($post['set'])){
            $controller = new SettingsController($system, $post);
            $this->redirect = "../sender.php";
        }
        if(isset($post['encode'])){
            //TODO error checking and handling
            if($system->getSender()->setCode(trim(strip_tags($post['code']))) == true){ //OKAY code

                $system->extraCode($system->getSender()->getCode());
                $prepared = $this->prepare(strip_tags($post['dec']));
                $system->encode($prepared);
                $system->setFrom(strip_tags($post['dec'])); //left box keeps message u are coding
                $system->reset(); //sets the letter values back to what it was when started
                $system->getSender()->setMessage($system->getEncoded());

            }

        }
        if(isset($post['send'])){
            if($system->getSender()->getMessage() != "") {
                $senders = new Senders($site);

                $senders->sendMessage($system->getSender());

                $system->getSender()->clearCode();
                $system->clearMessages();
                $system->getSender()->clearRecipients();
            }
        }
    }
}