# Yii2 Bootstrap Markdown Editor

Yii2 Markdown Editor based on [Bootstrap Markdown](http://www.codingdrama.com/bootstrap-markdown/).

This component use folowing libraries:
* [Marked](https://github.com/chjj/marked) -- a full-featured markdown parser and compiler, written in JavaScript.
* [To markdown](https://github.com/domchristie/to-markdown) -- an HTML to Markdown converter written in javascript.
* [Bootstrap Markdown](http://www.codingdrama.com/bootstrap-markdown/) -- JSimple Markdown editing tools that works!


## Installation

### Composer

The preferred way to install this extension is through [Composer](http://getcomposer.org/).

Either run

```
php composer.phar require efureev/yii2-bootstrap-markdown-editor "dev-master"
```

or add

```
"efureev/yii2-bootstrap-markdown-editor": "dev-master"
```

to the require section of your ```composer.json```


## Usage

### Active widget

In view in active form:

```php
<?php

use yii\widgets\ActiveForm;
use efureev\markdown\MarkdownEditor;
?>

<div class="active-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'content')->widget(MarkdownEditor::className(), [
        'clientOptions' => [
            'language' => Yii::$app->language,
            'additionalButtons' => [
                'drink' => [
                    'cmdBeer' => [
                        'title' => 'Beer',
                        'toggle' => false,
                        'icon' => 'glyphicon glyphicon-glass',
                        'callback' => 'function(e){alert("sdasda");}'
                    ],
                    'cmdBeer2' => [
                        'title' => 'Beer2',
                        'toggle' => true,
                        'icon' => 'glyphicon glyphicon-glass',
                        'callback' => 'function(e){
                            // Replace selection with some drinks
                            var chunk, cursor,
                                selected = e.getSelection(), content = e.getContent(),
                                drinks = ["Heinekken", "Budweiser",
                                        "Iron City", "Amstel Light",
                                        "Red Stripe", "Smithwicks",
                                        "Westvleteren", "Sierra Nevada",
                                        "Guinness", "Corona", "Calsberg"],
                                index = Math.floor((Math.random()*10)+1)
            
            
                              // Give random drink
                              chunk = drinks[index]
                
                              // transform selection and set the cursor into chunked text
                              e.replaceSelection(chunk)
                              cursor = selected.start
                
                              // Set the cursor
                              e.setSelection(cursor,cursor+chunk.length)
                            }'
                        ]
                    ]
                ]
        ],
        'options'       => ['data-provider' => 'markdown'],
        
    ]); ?>
    <?php ActiveForm::end(); ?>
</div>
```


### Simple widget

In view:

```php
<?php
use efureev\markdown\MarkdownEditor;

echo MarkdownEditor::widget([
    'name'          => 'md-editor',
    'value'         => '# test message',
    'clientOptions' => ['language' => Yii::$app->language],
    'options'       => ['data-provider' => 'markdown'],
]);
```


## Changelog

### v0.0.5

- add `additionalButtons`



## See also

* [Markdown reminder](http://sites.ateliers-pierrot.fr/markdown-extended/markdown_reminders.html)
* [Markdown cheatsheet](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet#wiki-hr)
* [GFM (Github Flawored Markdown)](http://github.github.com/github-flavored-markdown/)


## Author
[Ivan Yakovlev](https://github.com/uran1980/), e-mail: [uran1980@gmail.com](mailto:uran1980@gmail.com)
[Eugene Fureev](https://github.com/efureev/), e-mail: [furegin@yandex.ru](mailto:furegin@yandex.ru)
