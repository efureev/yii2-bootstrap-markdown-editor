<?php

namespace efureev\markdown\assets;

class TextareaAutosizeAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@bower/autosize/dist';

	public $js = [
		'autosize.min.js',
	];

	/**
	 * Initializes the bundle.
	 * If you override this method, make sure you call the parent implementation in the last.
	 */
	public function init()
	{
		$js = <<<JS
!(function ($) {
    $('body').on('focus', 'textarea', function () {
        autosize($(this));
    });
})(jQuery);
JS;
		\Yii::$app->view->registerJs($js, \yii\web\View::POS_READY);

		parent::init();
	}
}