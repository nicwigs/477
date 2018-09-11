<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/14/18
 * Time: 7:51 PM
 */

namespace Enigma;


/**
 * Email adapter class
 */
class Email {
    public function mail($to, $subject, $message, $headers) {
        mail($to, $subject, $message, $headers);
    }
}