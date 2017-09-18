<?php

namespace wonail\markdown;

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * Class MarkdownEditor
 *
 * @package wonail\markdown
 */
class MarkdownEditor extends InputWidget
{
    /**
     * @var array markdown options
     * @see [options page](https://github.com/sparksuite/simplemde-markdown-editor#configuration)
     */
    public $editorOptions = [];

    /**
     * @var int
     */
    public $zIndex = 1040;

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::beginTag('div', [
            'class' => 'wonail-markdown'
        ]);
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->attribute, $this->value, $this->options);
        }
        echo Html::endTag('div');

        $this->registerAssets();
    }

    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        MarkdownEditorAsset::register($view);
        $varName = Inflector::variablize('editor_' . $this->id);
        $script = "var {$varName} = new SimpleMDE(" . $this->getEditorOptions() . ');';
        $view->registerJs($script);
        $css = <<<CSS
.wonail-markdown{z-index:{$this->zIndex};}
.wonail-markdown .editor-toolbar.fullscreen{z-index:{$this->zIndex}}
.wonail-markdown .CodeMirror-fullscreen{z-index: {$this->zIndex}}
.wonail-markdown .editor-statusbar{z-index: {$this->zIndex}}
CSS;
        $view->registerCss($css);
    }

    /**
     * Return editor options in json format
     *
     * @return string
     */
    protected function getEditorOptions()
    {
        $this->editorOptions['element'] = new JsExpression('$("#' . $this->id . '")[0]');

        return Json::encode($this->editorOptions);
    }
}
