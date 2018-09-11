<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/19/18
 * Time: 12:08 AM
 */

namespace Enigma;


class RecipientsView extends View
{

    public function __construct(\Enigma\System $system,$get, $site)
    {
        parent::__construct($system);
        $this->get = $get;
        $this->site = $site;
    }

    public function present_header($tab = 0){
        return parent::present_header(View::TAB_RECIPIENTS);
    }

    public function present_body(){

        $html = '<div class="body"><form method="post" action="post/recipients.php">';
        if(isset($this->get['q'])){
            $search = trim(strip_tags($this->get['q']));
            $users = new Users($this->site);
            $results = $users->search($search);

            $html .= '<div class="dialog receipients">';
            if($results == array()){
                $html .= '<p>Query returned no results!</p>';
                $html .= '<p><input type="submit" name="cancel" value="Ok"></p>';
            }else{
                $html .= '<p>Select a user to add to the list of recipients.</p><table><tbody>';
                foreach($results as $user){
                    $id = $user->getID();
                    $name = $user->getName();
                    $html .= <<<HTML
                    <tr><td><input type="radio" name="recipient" value="$id" <="" td=""></td><td>$name</td></tr> 
HTML;
                }
                $html .= '</tbody></table>';
                $html .= <<<HTML
                    <p><input type="submit" name="add" value="Add"> <input type="submit" name="cancel" value="Cancel"></p>
HTML;
            }
            $html .= <<<HTML
</div></form>
        </div>
HTML;


        }

        //<input type="hidden" name="search" value="owen">


        return $html;



    }
    private $get;
    private $site;
}