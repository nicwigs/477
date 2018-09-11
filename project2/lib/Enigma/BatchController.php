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

}
