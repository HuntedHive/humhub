<?php

    use yii\helpers\Html;
?>
<div class="panel panel-default">
    <div
        class="panel-heading"><?php echo Yii::t('UserModule.views_profile_about', '<strong>About</strong> this user'); ?></div>

    <div class="panel-body">

        <?php $firstClass = "active"; ?>


        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <?php foreach ($user->profile->getProfileFieldCategories() as $category): ?>
                <li class="<?php echo $firstClass;
                $firstClass = ""; ?>"><a href="#profile-category-<?php echo $category->id; ?>"
                                         data-toggle="tab"><?php echo Html::encode(Yii::t($category->getTranslationCategory(), $category->title)); ?></a>
                </li>
            <?php endforeach; ?>
            <li class=""><a href="#profile-category-teacher-information"
                                     data-toggle="tab">Teacher Information</a>
            </li>
        </ul>

        <?php $firstClass = "active"; ?>

        <div class="tab-content">
            <?php foreach ($user->profile->getProfileFieldCategories() as $category): ?>

                <div class="tab-pane <?php echo $firstClass;
                $firstClass = ""; ?>" id="profile-category-<?php echo $category->id; ?>">
                    <form class="form-horizontal" role="form">
                        <?php foreach ($user->profile->getProfileFields($category) as $field) : ?>

                            <div class="form-group">
                                <label
                                    class="col-sm-3 control-label"><?php echo Html::encode(Yii::t($field->getTranslationCategory(), $field->title)); ?></label>


                                <?php if (strtolower($field->title) == 'about') { ?>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo humhub\widgets\RichText::widget(['text' => $field->getUserValue($user, true)]); ?></p>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $field->getUserValue($user, false); ?></p>
                                    </div>
                                <?php } ?>
                            </div>

                        <?php endforeach; ?>

                    </form>
                </div>
            <?php endforeach; ?>
            <div class="tab-pane" id="profile-category-teacher-information">
                <form class="form-horizontal" role="form">
                    <div class="form-group row">
                        <label
                            class="col-sm-3 control-label">Teacher level</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user->teacherInformation->level)?></p>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-sm-3 control-label">Teacher type</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo htmlspecialchars($user->teacherInformation->type)?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-sm-3 control-label">Subject area(s)</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo htmlspecialchars(join(', ', $user->teacherInformation->subjectAreasArray))?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-sm-3 control-label">Teaching interests</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo htmlspecialchars(join(', ', $user->teacherInformation->interestsArray))?></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


</div>
