<?php

namespace backend\behaviors;

use Yii;
use yii\base\Behavior;

class Amiadmin extends Behavior
{
    public function events()
    {
        return [ yii\web\Controller::EVENT_BEFORE_ACTION => 'checkIsMeAdmin'];
    }

    public function checkIsMeAdmin()
    {
       return (Yii::$app->user->id==1)?true:false;
	}

    
}
