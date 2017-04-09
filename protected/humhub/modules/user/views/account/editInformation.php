<?php

use yii\widgets\ActiveForm;
use humhub\compat\CHtml;
use yii\helpers\Url;
use yii\helpers\Html;
use humhub\modules\logicenter\models\LogicEntry;
use humhub\modules\registration\models\ManageRegistration;
use humhub\modules\user\models\UserRegistrationDetail;
?>
<div class="panel-heading">
    <?php echo Yii::t('UserModule.views_account_editInformation', '<strong>Teacher</strong> information'); ?>
</div>
<div class="panel-body">
    <?php if ($teacherInformation->getErrors('level')): ?>
        <div class="row errorMessage">
            <?php foreach($teacherInformation->getErrors('level') as $error): ?>
                <div class="col-sm-8 error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <?php

        $form = \yii\bootstrap\ActiveForm::begin(array(
            'id' => 'account-edit-information',
            'action' => Url::toRoute("/user/account/edit-information"),
        ));
        ?>
        <div class="form-group col-sm-8">
            <label class="control-label" for="teacher_level">Select teacher level *</label>
            <?php echo Html::activeDropDownList(
                    $teacherInformation,
                    'levelValue',
                    $teacherInformation->getLevelDropdown(),
                    [
                        'class' => 'manage_reg selectpicker form-control show-tick',
                        'data-type' => UserRegistrationDetail::TYPE_TEACHER_LEVEL,
                        'name' => 'level',
                        'id' => 'teacher_level',
                        "title" => "Select teacher level...",
                    ]
            ); ?>
        </div>
    </div><div class="row">
        <div class="form-group col-sm-1" style="margin-top: -5px;">
            <i class="fa fa-arrow-right custom-right-arrow"></i>
        </div>
        <div class="form-group col-sm-7">
            <?php echo Html::activeInput('text', $teacherInformation, 'levelOther', [
                'name' => 'level_other',
                'id' => 'teacher_level_other',
                'class' => 'manage_reg form-control'
            ]); ?>
        </div>
    </div>
    <?php if ($teacherInformation->getErrors('type')): ?>
        <div class="row errorMessage">
            <?php foreach($teacherInformation->getErrors('type') as $error): ?>
                <div class="col-sm-8 error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="form-group col-sm-8">
            <label class="control-label" for="accountsettings-tags">Select teacher type *</label>
            <?php echo Html::activeDropDownList(
                $teacherInformation,
                'typeValue',
                $teacherInformation->getTypeDropdown(),
                [
                    'class' => 'manage_reg teacher_type selectpicker form-control show-tick',
                    'name' => 'type',
                    'id' => 'teacher_type',
                    'title' => "Select teacher type..."
                ]
            ); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-1" style="margin-top: -5px;">
            <i class="fa fa-arrow-right custom-right-arrow"></i>
        </div>
        <div class="form-group col-sm-7">
            <?php echo Html::activeInput('text', $teacherInformation, 'typeOther', [
                'name' => 'type_other',
                'id' => 'teacher_type_other',
                'class' => 'manage_reg form-control'
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-8">
            <label class="control-label" for="accountsettings-tags">Select subject area(s)</label>
            <?php echo Html::activeDropDownList(
                $teacherInformation,
                'subjectAreasValue',
                    ['Select subject area(s)'=> ["please select teacher type"]],
                [
                'class' => 'manage_reg subject_area selectpicker form-control show-tick',
                'multiple title' => "Select subject area(s)...",
                'multiple'=>'multiple',
                'name' => 'subject_areas',
                'id' => 'subject_areas',
                'options'=> [ 0=>['disabled'=>'disabled'] ],
            ]); ?>
        </div>
    </div><div class="row">
        <div class="form-group col-sm-1" style="margin-top: -5px;">
            <i class="fa fa-arrow-right custom-right-arrow"></i>
        </div>
        <div class="form-group col-sm-7">
            <?php echo Html::activeInput('text', $teacherInformation, 'subjectAreasOther', [
                'name' => 'subject_area_other',
                'class' => 'manage_reg form-control',
                'id' => 'teacher_subject_area_other',
            ]); ?>
        </div>
    </div><div class="row">
        <div class="form-group col-sm-8">
            <label class="control-label" for="accountsettings-tags">Select teaching interests</label>
            <?php echo Html::activeDropDownList(
                $teacherInformation,
                'interestsValue',
                $teacherInformation->getInterestsDropdown(),
                [
                'class' => 'manage_reg teacher_interest selectpicker form-control show-tick',
                'data-type' => UserRegistrationDetail::TYPE_TEACHER_INTEREST,
                'multiple title' => "Select teaching interests...",
                    'multiple'=>'multiple',
                'name' => 'interests',
                'id' => 'interests',
                'title' => "Select teaching interests...",
                'options' => [0 => ['disabled' => 'disabled']],
            ]) ?>
        </div>
    </div><div class="row">
            <div class="form-group col-sm-1" style="margin-top: -5px;">
                <i class="fa fa-arrow-right custom-right-arrow"></i>
            </div>
            <div class="form-group col-sm-7">
                <?php echo Html::activeInput('text', $teacherInformation, 'interestsOther', [
                    'name' => 'interests_other',
                    'class' => 'manage_reg form-control',
                    'id' => 'teacher_interests_other',
                ]); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 row-padding-xs text-center">
            <small>* required fields</small>
        </div>
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
    var subjectAreas = <?php echo json_encode($teacherInformation->getSubjectAreasDropdown()); ?>;
    var selectedSubjectAreas = function(x) {
        r = {};
        for (var i = 0; i < x.length; i++) {
            r[x[i]] = x[i];
        }
        return r;
    }(<?php echo json_encode($teacherInformation->getSubjectAreasValue());?>)
    $(document).ready(function(){
        $('#teacher_level').change(function(e){
            var t = $(this);
            var other = $('#teacher_level_other');
            var selOption = t[0].selectedOptions[0].value;
            if (selOption === '__other__') {
                other.closest('div.row').show();
            } else {
                other.closest('div.row').hide();
                other.val('');
            }
        });

        $('#teacher_type').change(function(e){
            var t = $(this);
            var selOption;
            var other = $('#teacher_type_other');
            var subjAreasSelect = $('#subject_areas');
            var subjAreasOther = $('#teacher_subject_area_other');
            var _opts = t[0].selectedOptions;
            selOption = _opts[0].value;
            if (selOption === '__other__') {
                other.closest('div.row').show();
            } else if (selOption === '') {
                var od = $('<option/>');
                od.attr('value', '');
                od.html('Please select teacher type above');
                od.attr('disabled', 'disabled');
                subjAreasSelect[0].empty();
                subjAreasSelect[0].append(od);
                subjAreasSelect.selectpicker('refresh');
                other.closest('div.row').hide();
                other.val('');
            } else {
                other.closest('div.row').hide();
                other.val('');
            }

            var opts = subjectAreas[selOption];
            if (!opts || opts.length == 0) {
                opts = {'__other__': 'Other...'};
            }

            var replaceOptions = [];

            for (var i in opts) {
                var x = opts[i];
                var o = $('<option></option>');
                o.attr('value', i);
                console.log('XXX', i, subjAreasOther.val());
                if ((subjAreasOther.val() && i == '__other__') ||
                    (selectedSubjectAreas[i])) {
                    o.attr('selected', 'selected');
                }
                o.html(x);
                replaceOptions.push(o);
            }

            $(subjAreasSelect[0]).empty();
            $(subjAreasSelect[0]).append(replaceOptions);
            subjAreasSelect.selectpicker('refresh');
            subjAreasSelect.trigger('change');

        });

        $('#subject_areas').change(function(e){
            var t = $(this);
            var other = $('#teacher_subject_area_other');
            var hadOther = false;
            var selopts = t[0].selectedOptions;
            for (var i=0; i<selopts.length; i++) {
                var selOption = selopts[i].value;
                console.log('Looking at ', i, selOption);
                if (selOption === '__other__') {
                    hadOther = true;
                }
            }
            if (hadOther) {
                other.closest('div.row').show();
            } else {
                other.closest('div.row').hide();
                other.val('');
            }
        });

        $('#interests').change(function(e){
            var t = $(this);
            var other = $('#teacher_interests_other');
            var hadOther = false;
            for (var i in t[0].selectedOptions) {
                var selOption = t[0].selectedOptions[i].value;
                if (selOption === '__other__') {
                    hadOther = true;
                }
            }
            if (hadOther) {
                other.closest('div.row').show();
            } else {
                other.closest('div.row').hide();
                other.val('');
            }
        });

        $('#teacher_level').trigger('change');
        $('#teacher_type').trigger('change');
        $('#subject_areas').trigger('change');
        $('#interests').trigger('change');
    });
</script>
