<?php

use yii\helpers\Url;

use yii\helpers\Html;

?>
<title>Formulario</title>
<h1>Formulario</h1>
<p> <?= $mensaje ?></p>
<?= html::beginForm(
    url::toRoute('site/sform'), //ruta submit
    'get', //metodo
    ['class' => 'form-inline'] //parametros extra
)
?>
<div class="form-group">
    
<?= html::label("Label del campo", "campotxt")
?>
<?= html::textInput("campotxt", null, ["class" => "form-control"])
?>
</div>

<?= html::submitInput("Enviar",["class" => "form-control"])
?>

<?= html::endForm()
?>