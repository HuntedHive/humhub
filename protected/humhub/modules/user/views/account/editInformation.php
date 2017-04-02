<?php

use yii\widgets\ActiveForm;
use humhub\compat\CHtml;
use yii\helpers\Url;
use yii\helpers\Html;
use humhub\modules\logicenter\models\LogicEntry;
use humhub\modules\registration\models\ManageRegistration;
?>
<div class="panel-heading">
    <?php echo Yii::t('UserModule.views_account_editInformation', '<strong>Teacher</strong> information'); ?>
</div>
<div class="panel-body">
    <div class="row">
        <?php
        $manageReg = new ManageRegistration();
        $form = \yii\bootstrap\ActiveForm::begin(array(
            'id' => 'account-edit-information',
            'action' => Url::toRoute("/user/account/edit-information"),
        ));
        ?>
        <div class="form-group col-sm-8">
            <label class="control-label" for="accountsettings-tags">Select teacher level *</label>
            <?php echo Html::activeDropDownList($manageReg, 'teacher_level', LogicEntry::getDropDown(ManageRegistration::TYPE_TEACHER_LEVEL, "Select teacher level"), [
                'class' => 'manage_reg selectpicker form-control show-tick',
                'data-type' => ManageRegistration::TYPE_TEACHER_LEVEL,
                "title" => "Select teacher level " . LogicEntry::getRequired(ManageRegistration::TYPE_TEACHER_LEVEL) . "...",
            ]); ?>
        </div>
        <div class="form-group col-sm-8">
            <label class="control-label" for="accountsettings-tags">Select teacher type *</label>
            <?php echo Html::activeDropDownList($manageReg, 'teacher_type', LogicEntry::getDropDown(ManageRegistration::TYPE_TEACHER_TYPE, "Select teacher type"), [
                'class' => 'manage_reg teacher_type selectpicker form-control show-tick',
                'data-type' => ManageRegistration::TYPE_TEACHER_TYPE,
                'title' => "Select teacher type " . LogicEntry::getRequired(ManageRegistration::TYPE_TEACHER_TYPE) . "..."
            ]); ?>
        </div>
        <div class="form-group col-sm-8">
            <label class="control-label" for="accountsettings-tags">Select subject area(s)</label>
            <?php echo Html::activeDropDownList($manageReg, 'subject_area', ['Select subject area(s)'=> ["please select teacher type"]]/*LogicEntry::getDropDownDepend()*/, [
                'class' => 'manage_reg subject_area selectpicker form-control show-tick',
                'data-type' => ManageRegistration::TYPE_SUBJECT_AREA,
                'multiple title' => "Select subject area(s) " . LogicEntry::getRequired(ManageRegistration::TYPE_SUBJECT_AREA) . "...",
                'multiple'=>'multiple',
                'options'=> [ 0=>['disabled'=>'disabled'] ],
            ]) ?>
        </div>
        <div class="form-group col-sm-8">
            <label class="control-label" for="accountsettings-tags">Select teaching interests</label>
            <?php echo Html::activeDropDownList($manageReg, 'teacher_interest', LogicEntry::getDropDown(ManageRegistration::TYPE_TEACHER_INTEREST, "Select teaching interests"), [
                'class' => 'manage_reg teacher_interest selectpicker form-control show-tick',
                'data-type' => ManageRegistration::TYPE_TEACHER_INTEREST,
                'multiple title' => "Select teaching interests " . LogicEntry::getRequired(ManageRegistration::TYPE_TEACHER_INTEREST) . "...",
                'multiple'=>'multiple',
                'title' => "Select teaching interests " . LogicEntry::getRequired(ManageRegistration::TYPE_TEACHER_INTEREST) . "...",
            ]) ?>
        </div>
    </div>
    <div class="col-sm-8 row-padding-xs text-center">
        <small>* required fields</small>
    </div>
        <div class="row">
            <div class="col-sm-8 text-center">
                <br>
                <?php echo Html::submitButton(Yii::t('UserModule.views_account_editInformation', 'Update'), array('class' => 'btn btn-primary')); ?>
                <?php \yii\bootstrap\ActiveForm::end(); ?>
            </div>
        </div>
</div>

<script type="text/javascript">
    $()
</script>
