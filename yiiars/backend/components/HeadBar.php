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


class HeadBar extends Widget 
{
	public $options = [];
	public $brand = [];
	public $sideBarButton = [];
	public $headBarMenu = [];

	/**
     * Initializes the widget.
     */
    public function init()
    {
    	parent::init();
    }

    public function run()
    {
    	return $this->render('layout/head-bar', [
    		'user' => Yii::$app->user->identity,
    	]);
    }
}

