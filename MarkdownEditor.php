<?php

namespace efureev\markdown;

use efureev\markdown\assets\MarkdownEditorAsset;

use yii\helpers\Json;
use yii\web\AssetBundle;
use yii\web\View;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


class MarkdownEditor extends InputWidget
{
    /**
     * @var array
     */
    public $clientOptions = [];

    /** @var  array|null */
    public $additionalButtons;

    /**
     * @var \efureev\markdown\assets\MarkdownEditorAsset
     */
    private $_assetBundle;

    public function init()
    {
        if ($this->hasModel()) {
            $this->options['id'] = Html::getInputId($this->model, $this->attribute);
        } else {
            $this->options['id'] = $this->getId();
        }
        $this->registerAssetBundle();
        $this->registerScript();
        $this->registerEvent();
    }

    /**
     * @return array
     */
    public function getClientOptionsDefaults()
    {
        return [
            'language' => \Yii::$app->language,
            'autofocus' => true,
        ];
    }

    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
    }

    public function registerAssetBundle()
    {
        $this->_assetBundle = MarkdownEditorAsset::register($this->getView());
    }

    private $_callback_replace_values = [];

    public function registerAdditionalButtons()
    {
        if (empty($this->additionalButtons) || !is_array($this->additionalButtons))
            return;

        $groups = [];
        foreach ($this->additionalButtons as $btnGroupName => $btnGroupData) {
            $btns = [];
            foreach ($btnGroupData as $btnName => $btnData) {
                $btnData['name'] = $btnName;

                if (!empty($btnData['callback'])) {
                    if (strpos($btnData['callback'], 'function(') === 0) {
                        $value = '%' . $btnGroupName . '_' . $btnName . '_callback%';
                        $this->_callback_replace_values['"' . $value . '"'] = $btnData['callback'];
                        $btnData['callback'] = $value;
                    }
                }

                $btns[] = $btnData;

            }

            if (!count($btns))
                continue;

            $groups[] = [
                'name' => $btnGroupName,
                'data' => $btns
            ];
        }

        $this->clientOptions['additionalButtons'] = [$groups];

    }

    public function registerScript()
    {
        $this->registerAdditionalButtons();

        $this->clientOptions['additionalButtons'];

        $config = Json::encode(ArrayHelper::merge(
            $this->getClientOptionsDefaults(),
            $this->clientOptions
        ));

        $config = str_replace(array_keys($this->_callback_replace_values), $this->_callback_replace_values, $config);

        $js = <<<SCRIPT
!(function ($) {
    $('#{$this->options['id']}').markdown($.extend({$config}, {
        onShow: function (e) {
            appMdEditor.fixPreviewButton(e);
        },
        onFocus: function (e) {
            appMdEditor.fixPreviewButton(e);
        }
    }));
})(window.jQuery);
SCRIPT;
        $this->getView()->registerJs($js, View::POS_READY);
    }

    public function registerEvent()
    {
        if (!empty($this->clientEvents)) {
            $js = [];
            foreach ($this->clientEvents as $event => $handle) {
                $js[] = "jQuery('#{$this->options['id']}').on('{$event}',{$handle});";
            }
            $this->getView()->registerJs(implode(PHP_EOL, $js));
        }
    }

    /**
     * @return MarkdownEditorAsset
     */
    public function getAssetBundle()
    {
        if (!($this->_assetBundle instanceof AssetBundle)) {
            $this->registerAssetBundle();
        }

        return $this->_assetBundle;
    }
}

