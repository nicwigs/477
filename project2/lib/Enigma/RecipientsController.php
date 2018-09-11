<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/20/18
 * Time: 1:55 AM
 */

namespace Enigma;


class RecipientsController extends Controller
{


    public function __construct(\Enigma\System $system, $post)
    {
        parent::__construct($system);
        $this->redirect = "../sender.php";

        if(isset($post['add']) and isset($post['recipient'])) {
            $system->getSender()->addRecipients(strip_tags($post['recipient']));
        }

    }

}