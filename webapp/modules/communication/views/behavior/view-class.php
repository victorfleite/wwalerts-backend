<?php

use yii\helpers\Html;

// Register the hightlight scripts
nezhelskoy\highlight\HighlightAsset::register($this);

/* @var $this yii\web\View */
/* @var $model webapp\modules\communication\models\Behavior */

$this->title = $model->class;
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'behaviors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="behavior-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
<?= Html::a(Yii::t('translation', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>    
    </p>

    <div id="clipboard-container">
	<pre><code class="php"><?php echo $classCode ?></code></pre>
    </div>

</div>
