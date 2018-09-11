<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/6/18
 * Time: 11:27 PM
 */

namespace Enigma;
use Enigma\System as System;

class IndexController extends Controller
{
    public function __construct(System $system, $post){
        Controller::__construct($system);
        $this->redirect = './../enigma.php';

        if(isset($post['name'])){
            $system->name(strip_tags($post['name']));
            if($system->check() != System::VALID){
                $this->redirect = './../index.php';
            }

        }
    }
}