<?php
/**
 * @author czhen <wowzhaunyong@gmail.com>
 */
namespace backend\components;


use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Widget;
use yii\helpers\Html;

use common\models\User;


class LeftBar extends Widget 
{
	public $options = [];
	/**
     * Initializes the widget.
     */
    public function init()
    {
    	parent::init();
    }

    public function run()
    {
    	return $this->render('layout/left-bar', [
    		'user' => Yii::$app->user->identity,
            'main_nav' => Yii::$app->params['mainNavigation'],
    	]);
    }
}

