<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use dosamigos\ckeditor\CKEditor;
use app\models\Jogo;
use app\models\JogoFaseCategoria;

/* @var $this yii\web\View */
/* @var $model app\models\JogoFase */
/* @var $form yii\widgets\ActiveForm */
?>

<?php

use dosamigos\selectize\SelectizeTextInput;

?>

<div class="jogo-fase-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]); ?>

    <?php
    echo Form::widget([       // 1 column layout
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [        
            'jogo_id' => ['type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(Jogo::find()->all(), 'id', 'nome'),
                'options' => [
                ]],
            'nome' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Nome da Fase']]
        ]
    ]);
    ?>

    <?php
    echo Form::widget([       // 1 column layout
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'mission' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Mission']],
            'jogo_fase_categoria_id' => ['type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(JogoFaseCategoria::find()->all(), 'id', 'categoria'),
                'options' => [
                ]],
        ]
    ]);
    ?>

    <?= $form->field($model, 'tagNames')->widget(SelectizeTextInput::className(), [
    // calls an action that returns a JSON object with matched
    // tags
    'loadUrl' => ['tag/list'],
    'options' => ['class' => 'form-control'],
    'clientOptions' => [
        'plugins' => ['remove_button'],
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
        'create' => true,
    ],
    ])->hint('Use virgulas para separar tags') ?>
   
    <?=
    $form->field($model, 'descricao')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])
    ?>
    <?=
    $form->field($model, 'objetivo_jogo')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])
    ?>
    <?=
    $form->field($model, 'objetivo_pedagogico')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])
    ?>

    <?=
    $form->field($model, 'regra_jogo')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])
    ?>

    <?=
    $form->field($model, 'exemplo')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])
    ?>

<?=
$form->field($model, 'habilidades')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'basic'
])
?>

<?=
$form->field($model, 'disciplina')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'basic'
])
?>

<?=
$form->field($model, 'indicacao')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'basic'
])
?>

<?=
$form->field($model, 'acesso')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'basic'
])
?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
