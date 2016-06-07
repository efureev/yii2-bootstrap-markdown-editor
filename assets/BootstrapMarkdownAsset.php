<?php

namespace efureev\markdown\assets;

use yii\web\AssetBundle;

class BootstrapMarkdownAsset extends AssetBundle
{
	public $sourcePath = '@bower/bootstrap-markdown';

	public $js = [
		'js/bootstrap-markdown.js',
	];

	public $css = [
		'css/bootstrap-markdown.min.css',
	];

	public $depends = [
		'yii\web\JqueryAsset',
		'yii\bootstrap\BootstrapAsset',

		'efureev\markdown\assets\MarkedAsset',
		'efureev\markdown\assets\ToMarkdownAsset'
	];

	public function init()
	{
		$this->registerLocale();

		parent::init();
	}

	public function registerLocale()
	{
		$lang = preg_replace('/^([a-z]{2})(-[A-Za-z]{2})$/','$1',\Yii::$app->language);
		$localeAsset = 'locale/bootstrap-markdown.' . $lang . '.js';

		if ( file_exists(\Yii::getAlias($this->sourcePath . '/' . $localeAsset)) ) {
			$this->js[] = $localeAsset;
		}
	}
}