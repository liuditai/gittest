<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '给测试任务"'.$teName.'"录入测试结果';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1>给测试任务"<?= $teName ?>"录入测试结果：</h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute'=>'testCase.title',
                'content' => function ($model, $key, $index, $column) {
                    return Html::a($model->testCase->title,['test-result/update','id'=>$key]);
                }

            ],

            'testCase.repo.name',
            [
                'attribute' => 'status',
                'content' => function ($model, $key, $index, $column) {
                    if (is_null($model->status) || empty($model->status)) {
                        return "未完成";
                    }
                    if ($model->status === 's') {
                        return "Success";
                    }
                    if ($model->status === 'f') {
                        return "Fail";
                    }
                }                
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url,$model,$key) {
                        return Html::a('写入测试步骤结果',['test-step-result/results','tcrid'=>$model->id]);
                    }
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ]
        ],
    ]) ?>
</div>
