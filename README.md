# Markdown Widget for Yii2

Widget based on [simplemde-markdown-editor](https://github.com/sparksuite/simplemde-markdown-editor)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist wonail/yii2-markdown "*"
```

or add

```json
"wonail/yii2-markdown": "*"
```

to the require section of your composer.json.

## Usage

Once the extension is installed, simply add widget to your page as follows:

1) Usage with ActiveForm and model
```php
<?= $form->field($model, 'content')->widget(\wonail\markdown\MarkdownEditor::class, [
    'editorOptions' => [
        'showIcons' => ["code", "table"],
        'spellChecker' => false,
    ],
]); ?>
```
2) Usage without ActiveForm and model
```php
<?= \wonail\markdown\MarkdownEditor::widget([
    'name' => 'markdown-editor',
    'editorOptions' => [
        'showIcons' => ["code", "table"],
        'autofocus' => true,
        'spellChecker' => false,
    ],
]);
?>
```

## Markdown Editor Options

You can find them on the [options page](https://github.com/sparksuite/simplemde-markdown-editor#configuration)
