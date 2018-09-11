<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/7/18
 * Time: 8:22 PM
 */

namespace Enigma;


class EnigmaController extends Controller
{
    public function __construct(System $system, $post)
    {
        Controller::__construct($system);
        $this->redirect = './../enigma.php';
        if (isset($post['key'])) {
            $system->setActive(strip_tags($post['key']));
        }
        if (isset($post['reset'])) {
            $system->reset();
        }
    }
}