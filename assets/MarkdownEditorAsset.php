<?php

namespace efureev\markdown\assets;

use yii\web\AssetBundle;

class MarkdownEditorAsset extends AssetBundle
{
	public $sourcePath = '@efureev/markdown/assets';

	public $js = [
		'js/app-markdown-editor.js',
	];

	public $css = [
		'css/app-markdown-editor.css',
	];

	public $depends = [
		'efureev\markdown\assets\BootstrapMarkdownAsset',
		'efureev\markdown\assets\TextareaAutosizeAsset',
		'uran1980\yii\assets\codePrettify\CodePrettifyAsset',
	];
}