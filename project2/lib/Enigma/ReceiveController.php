<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/19/18
 * Time: 12:23 PM
 */

namespace Enigma;


class ReceiveController extends Controller
{

    public function __construct(\Enigma\System $system, $post, $site, $user)
    {
        parent::__construct($system);
        $this->redirect = "../receiver.php";
        $system->getReceiver()->setID($user->getId());

        if(isset($post['message'])){ //someone is selected
            $messageID = trim(strip_tags($post['message']));
            $system->getReceiver()->setMessageID($messageID);

            $receivers = new Receivers($site);
            $results = $receivers->fetchMessage($messageID);
            $code = $results['code'];
            $encoded = $results['message'];

            $system->getReceiver()->setCode($code);
            $system->extraCode($code);
            $prepared = $this->prepare($encoded);
            $system->decode($prepared);
            $system->setTo($encoded); //left box keeps message u are coding
            $system->reset(); //sets the letter values back to what it was when started
            $system->getReceiver()->setMessage($system->getDecoded());

            $this->redirect = "../receiver.php?s";
        }

        if(isset($post['set'])){
            $controller = new SettingsController($system, $post);
            $this->redirect = "../receiver.php";
        }



    }
}