<?php

declare(strict_types=1);

namespace backend\views\service;

use backend\models\form\ServiceForm;
use common\yii\ViewFile;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

/**
 * Создание услуги.
 */
class Form_ViewFile extends ViewFile
{
	/**
	 * @param ServiceForm $foprm Провайдер данных
	 */
	public function __construct(ServiceForm $form)
	{
		$this->renderer = function() use ($form) {
?>
<div>
	<div class="container">
        <div class="block-form">
			<?php $htmlForm = ActiveForm::begin(); ?>

			<?= $htmlForm->field($form, $form::ATTR_NAME)->textInput(['maxlength' => true]) ?>
			<?= $htmlForm->field($form, $form::ATTR_DESCRIPTION)->textInput(['maxlength' => true]) ?>
			<?= $htmlForm->field($form, $form::ATTR_CODE)->textInput(['maxlength' => true]) ?>
			<?= $htmlForm->field($form, $form::ATTR_CITY_ID)->dropDownList(ServiceForm::getCitiesForDropdown()) ?>
			<?= $htmlForm->field($form, $form::ATTR_STATUS)->dropDownList($form::STATUSES) ?>

            <div class="form-group">
				<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

			<?php $htmlForm::end(); ?>

        </div>
	</div>
</div>
<?php
		};
	}
}