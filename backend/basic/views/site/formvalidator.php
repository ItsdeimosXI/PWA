<?php
use yii\helpers\Html;

use yii\widgets\ActiveForm;

?>
<title>Formulario V2</title>
<h1> Formulario Validado </h1>

<h3><?= $mensaje ?></h3>

<?php

$form = ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "enableClientValidation" => true,
    "enableAjaxValidation" => false

]);

?>


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