<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
<h3>Lista de la tabla usuarios : </h3>
<a href="<?= Url::toRoute("site/formvalidator") ?>" class="btn btn-primary">Nuevo</a>
</div>
<h3><?= $mensaje ?></h3>

<?php
$form = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("site/usuario"),
    "enableClientValidation" => true
]);
?>
<div class="row">
    <div class="form-group mx-sm-3 mb-2">
        <?= $form->field($model, "query")->input("search") ?>
    </div>
    <?= Html::submitInput("Buscar", ["class" => "btn btn-primary mb-2"]) ?>
</div>
</div>
<?php
$form->end();
?>
<table class="table table-bordered">
    <tr>
        <th>
            Código:
        </th>
        <th>
            Nombre:
        </th>
        <th>
            Email:
        </th>
        <th>
            Acciones
        </th>
    </tr>
    <?php foreach ($data as $row) : ?>
        <tr>
            <td><?= $row->id ?></td>
            <td><?= $row->nombre ?></td>
            <td><?= $row->email ?></td>
            <td><a href="<?= Url::toRoute(["site/delusuario", 'id' => $row->id]) ?>" class="btn btn-danger">Eliminar</a></td>
        </tr>
    <?php endforeach ?>
</table>