<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/11/18
 * Time: 12:51 AM
 */

namespace Enigma;


class User
{
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Constructor
     * @param $row Row from the user table in the database
     */
    public function __construct($row) {
        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->name = $row['name'];
    }



    const SESSION_NAME = 'user';


    private $id;		///< The internal ID for the user
    private $email;		///< Email address
    private $name; 		///< Name as last, first

}