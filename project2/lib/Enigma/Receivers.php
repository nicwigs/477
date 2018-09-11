<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/20/18
 * Time: 4:08 AM
 */

namespace Enigma;


class Receivers extends Table
{

    public function __construct(Site $site) {
        parent::__construct($site, "receive");
    }

    public function populateReceive($userid, $messageid){


        $sql = <<<SQL
INSERT INTO $this->tableName(userid, messageid)
values(?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($userid, $messageid));

    }

    public function fetchMessages($recipientid){

        $senders = new Senders($this->site);
        $sendersTable = $senders->getTableName();

        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT msg.userid, msg.message, msg.code, msg.date, msg.id, u.name
from $this->tableName r,
     $sendersTable msg,
     $usersTable u
where r.messageid = msg.id and msg.userid = u.id and 
      r.userid=?
SQL;


        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($recipientid));
        if($statement->rowCount() === 0) {
            return array();
        }
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $results;

    }

    public function fetchMessage($messageid){
        $senders = new Senders($this->site);
        $sendersTable = $senders->getTableName();

        $sql = <<<SQL
SELECT msg.message, msg.code
from $sendersTable msg
where msg.id = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($messageid));
        if($statement->rowCount() === 0) {
            return array();
        }
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return $result;

    }
}