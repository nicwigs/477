<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/20/18
 * Time: 4:08 AM
 */

namespace Enigma;


class Senders extends Table
{

    public function __construct(Site $site) {
        parent::__construct($site, "message");
    }

    public function sendMessage(Sender $sender){


        $sql = <<<SQL
INSERT INTO $this->tableName(userid, message, code,date)
values(?, ?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($sender->getSenderID(), $sender->getMessage(), $sender->getCode(),date("Y-m-d H:i:s") ));
        $messageID = $this->pdo()->lastInsertId();

        $receivers = new Receivers($this->site);
        foreach($sender->getRecipients() as $recipient => $recipientID){
            $receivers->populateReceive($recipientID,$messageID);
        }

    }
}