<?php

namespace efureev\markdown\assets;

use yii\web\AssetBundle;

class ToMarkdownAsset extends AssetBundle
{
	public $sourcePath = '@bower/to-markdown/dist';

	public $js = [
		'to-markdown.js',
	];
}