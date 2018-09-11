<?php

/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Enigma\Site $site) {

    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('wiggin63@cse.msu.edu');
    $site->setRoot('/~wiggin63/project2');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=wiggin63',
        'wiggin63',       // Database user
        '1000570',     // Database password
        'p2_');            // Table prefix
};