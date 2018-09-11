<?php
/**
 * Created by PhpStorm.
 * User: nicwiggins
 * Date: 6/8/18
 * Time: 12:27 AM
 */

namespace Enigma;


class SettingsController extends Controller
{
    public function __construct(System $system, $post)
    {
        Controller::__construct($system);
        $this->redirect = './../settings.php';
        if (isset($post['set'])) {
            if(isset($post['initial-1']) and isset($post['initial-2']) and isset($post['initial-3'])){
                if($this->validSetting(strip_tags($post['initial-1'])) and $this->validSetting(strip_tags($post['initial-2'])) and $this->validSetting(strip_tags($post['initial-3']))){
                    if($this->validRotors(strip_tags($post['rotor-1']),strip_tags($post['rotor-2']),strip_tags($post['rotor-3']))){
                        $system->setRotorSettingsStored(1,ucfirst(strip_tags($post['initial-1'])));
                        $system->setRotorSettingsStored(2,ucfirst(strip_tags($post['initial-2'])));
                        $system->setRotorSettingsStored(3,ucfirst(strip_tags($post['initial-3'])));
                        $system->setRotors(1,strip_tags($post['rotor-1']));
                        $system->setRotors(2,strip_tags($post['rotor-2']));
                        $system->setRotors(3,strip_tags($post['rotor-3']));

                        $system->setSettingError('');
                    }else{
                        $system->setSettingError('Rotor values must be unique!');
                    }
                }else{
                    $system->setSettingError('Please enter letter A -> Z');
                }
            }else{
                $system->setSettingError('Must enter value for each setting!');
            }
        }

    }

    public function validSetting($setting){
        $setting = ucfirst($setting);
        if(strlen($setting) !== 1 || strcmp($setting, 'A') < 0 || strcmp($setting, 'Z') > 0) {
            return false;
        }
        return true;
    }

    public function validRotors($r1, $r2, $r3){
        return $r1 != $r2 and $r2 != $r3 and $r1 != $r3;
    }
}