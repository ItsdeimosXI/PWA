<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<a href="<?= Url::toRoute("site/usuario")?>" class="btn btn-success">Listar usuarios</a>
<title>Formulario V2</title>
<h1> Formulario Validado </h1>

<p> <?= $mensaje ?></p>

<?php

$form = ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "enableClientValidation" => true,
    "enableAjaxValidation" => false
]);
?>
<div class="form-group">

    <?= $form->field($model, "id")->input("text") ?>

</div>
<div class="form-group">

    <?= $form->field($model, "nombre")->input("text") ?>

</div>
<div class="form-group">

    <?= $form->field($model, "email")->input("email") ?>

</div>
<?= html::submitInput("Enviar", ["class" => "btn btn-primary"]) ?>


<?php
$form->end();
?>