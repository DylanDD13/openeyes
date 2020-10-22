<?php
/**
 * OpenEyes.
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */
?>
<?php
$uri = preg_replace('/^\//', '', preg_replace('/\/$/', '', $_SERVER['REQUEST_URI']));

if (!Yii::app()->user->isGuest) {
    $user = User::model()->findByPk(Yii::app()->user->id);
    if (!preg_match('/^profile\//', $uri)) {
        if (!$user->has_selected_firms && !$user->global_firm_rights && empty(Yii::app()->session['shown_reminder'])) {
            Yii::app()->session['shown_reminder'] = true;
            $this->widget('SiteAndFirmWidgetReminder');
        }
    }
    if (empty(Yii::app()->session['user'])) {
        Yii::app()->session['user'] = User::model()->findByPk(Yii::app()->user->id);
    }
    $user = Yii::app()->session['user'];
    $menuHelper = new MenuHelper(Yii::app()->params['menu_bar_items'], Yii::app()->user, $uri);
    $navIconUrl = Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.assets.newblue')) . '/svg/oe-nav-icons.svg';
    ?>

    <div class="oe-user-banner">
        <?php $this->renderPartial('//base/_banner_watermark'); ?>
    </div>
    <div class="oe-user">
        <ul class="oe-user-profile-context">
            <li><?= $user->first_name . ' ' . $user->last_name; ?>
                <?php if (Yii::app()->params['profile_user_can_edit']) { ?>
                    <a href="<?= Yii::app()->createUrl('/profile'); ?>">profile</a>
                <?php } ?>
            </li>

            <li><?= Site::model()->findByPk($this->selectedSiteId)->short_name; ?></li>
            <li>
                <?= Firm::model()->findByPk($this->selectedFirmId)->getNameAndSubspecialty(); ?>
                <a id="change-firm" href="#" data-window-title="Select a new Site and/or <?= Firm::contextLabel() ?>">change</a>
            </li>
        </ul>
    </div>
    <div class="oe-nav">
        <ul class="oe-big-icons">
            <li class="oe-nav-btn">
                <a class="icon-btn" href="/">
                    <svg viewBox="0 0 80 40" class="icon home">
                        <use xlink:href="<?= $navIconUrl . '#home-icon'; ?>"></use>
                    </svg>
                </a>
            </li>
            <li class="oe-nav-btn">
                <a class="icon-btn" href="<?= Yii::app()->createUrl('patient/create') ?>">
                    <svg viewBox="0 0 60 60" class="icon clinic ">
                    <title>patient</title>
        <style>*{fill:#fff;}</style>
                    <path d="M 47.098 42.545 L 47.098 42.365 C 47.018 41.515 46.938 40.765 46.898 40.165 C 46.518 35.225 44.958 23.745 38.468 22.345 C 37.352 20.835 35.94 19.569 34.318 18.625 C 35.613 16.782 36.311 14.586 36.318 12.335 C 36.318 3.79 27.068 -1.551 19.668 2.722 C 16.234 4.704 14.118 8.369 14.118 12.335 C 14.117 13.149 14.208 13.96 14.388 14.755 C 13.732 14.383 13 14.164 12.248 14.115 C 5.378 13.755 3.248 24.865 2.688 29.655 C 2.618 30.215 2.518 30.915 2.398 31.715 C 1.488 37.975 0.818 43.795 2.638 46.365 C 3.728 47.905 5.638 48.705 8.108 48.605 C 8.595 48.574 9.079 48.51 9.558 48.415 C 12.278 51.805 18.558 57.225 30.958 57.225 C 31.488 57.225 32.148 57.225 32.758 57.175 L 32.878 57.425 C 34.018 59.595 37.308 60.975 39.978 61.215 C 40.298 61.215 40.618 61.215 40.918 61.215 C 42.885 61.324 44.791 60.515 46.078 59.025 C 48.248 56.285 47.798 49.665 47.098 42.545 Z M 31.808 36.285 C 31.808 36.835 31.888 37.285 31.898 37.715 C 31.998 39.895 31.968 42.545 31.898 45.125 C 31.898 48.335 31.898 50.985 31.978 53.035 C 16.898 53.355 11.978 45.035 11.498 44.035 C 9.958 41.125 9.498 22.395 14.598 18.925 C 15.048 18.835 15.538 18.755 16.068 18.695 C 19.512 23.595 26.23 24.867 31.228 21.565 C 32.212 22.052 33.13 22.664 33.958 23.385 L 33.658 23.685 C 31.308 26.225 31.458 31.295 31.808 36.285 Z M 25.188 5.335 C 30.577 5.335 33.944 11.168 31.25 15.835 C 28.556 20.501 21.82 20.501 19.126 15.835 C 18.511 14.77 18.188 13.563 18.188 12.335 C 18.188 8.469 21.322 5.335 25.188 5.335 Z M 36.008 37.535 C 36.008 37.105 35.948 36.535 35.908 35.955 C 35.738 33.555 35.328 27.955 36.678 26.475 C 36.785 26.344 36.95 26.276 37.118 26.295 C 39.818 26.295 42.118 32.125 42.768 40.465 C 42.818 41.135 42.898 41.975 42.998 42.925 C 43.288 45.865 44.158 54.805 42.848 56.475 C 42.145 57.036 41.228 57.253 40.348 57.065 C 38.917 57.015 37.555 56.442 36.518 55.455 C 35.968 54.455 36.028 48.625 36.058 45.145 C 36.088 42.555 36.118 39.845 36.018 37.535 Z M 7.388 44.485 C 6.861 44.521 6.343 44.336 5.958 43.975 C 4.958 42.535 6.058 34.845 6.428 32.295 L 6.428 32.165 C 6.202 36.296 6.525 40.438 7.388 44.485 Z"/>
  <path d="M 32.143 1.677 H 37.351 V 11.093 H 47.763 V 15.802 H 37.351 V 25.218 H 32.143 V 15.802 H 21.73 V 11.093 H 32.143 Z" style="" transform="matrix(0.999998, 0.002188, -0.002188, 0.999998, 11.052019, 0.824117)" bx:shape="cross 21.73 1.677 26.033 23.541 4.709 5.208 0.5 1@3401b835"/>
           </svg>
                </a>
            </li>
            <?= $menuHelper->render($navIconUrl) ?>
            <li class="oe-nav-btn">
                <a class="icon-btn" href="<?= Yii::app()->createUrl('worklist/view') ?>">
                    <svg viewBox="0 0 80 40" class="icon clinic ">
                        <use xlink:href="<?= $navIconUrl . '#clinic-icon' ?>"></use>
                    </svg>
                </a>
            </li>
            <li class="oe-nav-btn js-hotlist-panel-wrapper">
                <div class="nav-js-btn" id="js-nav-hotlist-btn"
                     data-fixable="<?= $this->fixedHotlist ? 'true' : 'false' ?>">
                    <svg viewBox="0 0 80 40" class="icon hotlist">
                        <use xlink:href="<?= $navIconUrl . '#hotlist-icon' ?>"></use>
                    </svg>
                </div>
                <?php $this->renderPartial('//base/_hotlist'); ?>
            </li>
            
            <li class="oe-nav-btn">
                <a class="icon-btn" href="<?= Yii::app()->createUrl('/site/logout'); ?>">
                    <svg viewBox="0 0 80 40" class="icon logout">
                        <use xlink:href="<?= $navIconUrl . '#logout-icon'; ?>"></use>
                    </svg>
                    <img src="" class="icon-logout"/>
                </a>
            </li>
        </ul>
    </div>

<?php } ?>
