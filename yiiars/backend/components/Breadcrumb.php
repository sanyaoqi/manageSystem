<?php
/**
 * @author czhen <wowzhaunyong@gmail.com>
 */
namespace backend\components;


use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Widget;
use yii\helpers\Html;

class Breadcrumb extends Widget 
{
	/**
     * Initializes the widget.
     */
    public function init()
    {
    	parent::init();
    }

    public function run()
    {
    	return $this->render('common/breadcrumb');
    }
}

