<div class="row">
    <?php if (\Yii::$app->user->can('/config/*')) { ?>
        <div class="col-md-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3>                    
                        Configuração
                    </h3>

                    <p>
                        Configurações Gerais
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-1x fa-gears"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/config/index']) ?>" class="small-box-footer">
                    Acessar <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    <?php } ?> 
    <?php if (\Yii::$app->user->can('/admin/assignment/index')) { ?>
        <div class="col-md-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3>                    
                        Acesso
                    </h3>

                    <p>
                        Configurações de Acesso
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-1x fa-lock"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/admin/assignment/index']) ?>" class="small-box-footer">
                    Acessar <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    <?php } ?> 
</div>
<div class="row">
    <!-- ./col -->
    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>

                    <?= \backend\models\User::find()->count() ?> Jogadores
                </h3>

                <p>
                    Quantidade de Alunos
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-ios7-person"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to(['/user/admin']) ?>" class="small-box-footer">
                Acessar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>
                    Relatórios
                </h3>

                <p>
                    Relatórios Gerencias
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                Acessar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>
    <!-- ./col -->


</div>



</div>
