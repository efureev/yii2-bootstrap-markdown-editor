<?php

namespace efureev\markdown\assets;

use yii\web\AssetBundle;

class MarkedAsset extends AssetBundle
{
	public $sourcePath = '@bower/marked/lib';

	public $js = [
		'marked.js',
	];
}