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
                    <svg viewBox="0 0 80 40" class="icon clinic ">
                    <title>patient</title>
        <style>*{fill:#fff;}</style>
        <path d="M 52.068 42.617 L 52.068 42.437 C 51.988 41.587 51.908 40.837 51.868 40.237 C 51.488 35.297 49.928 23.817 43.438 22.417 C 42.322 20.907 40.91 19.641 39.288 18.697 C 40.583 16.854 41.281 14.658 41.288 12.407 C 41.288 3.862 32.038 -1.479 24.638 2.794 C 21.204 4.776 19.088 8.441 19.088 12.407 C 19.087 13.221 19.178 14.032 19.358 14.827 C 18.702 14.455 17.97 14.236 17.218 14.187 C 10.348 13.827 8.218 24.937 7.658 29.727 C 7.588 30.287 7.488 30.987 7.368 31.787 C 6.458 38.047 5.788 43.867 7.608 46.437 C 8.698 47.977 10.608 48.777 13.078 48.677 C 13.565 48.646 14.049 48.582 14.528 48.487 C 17.248 51.877 23.528 57.297 35.928 57.297 C 36.458 57.297 37.118 57.297 37.728 57.247 L 37.848 57.497 C 38.988 59.667 42.278 61.047 44.948 61.287 C 45.268 61.287 45.588 61.287 45.888 61.287 C 47.855 61.396 49.761 60.587 51.048 59.097 C 53.218 56.357 52.768 49.737 52.068 42.617 Z M 36.778 36.357 C 36.778 36.907 36.858 37.357 36.868 37.787 C 36.968 39.967 36.938 42.617 36.868 45.197 C 36.868 48.407 36.868 51.057 36.948 53.107 C 21.868 53.427 16.948 45.107 16.468 44.107 C 14.928 41.197 14.468 22.467 19.568 18.997 C 20.018 18.907 20.508 18.827 21.038 18.767 C 24.482 23.667 31.2 24.939 36.198 21.637 C 37.182 22.124 38.1 22.736 38.928 23.457 L 38.628 23.757 C 36.278 26.297 36.428 31.367 36.778 36.357 Z M 30.158 5.407 C 35.547 5.407 38.914 11.24 36.22 15.907 C 33.526 20.573 26.79 20.573 24.096 15.907 C 23.481 14.842 23.158 13.635 23.158 12.407 C 23.158 8.541 26.292 5.407 30.158 5.407 Z M 40.978 37.607 C 40.978 37.177 40.918 36.607 40.878 36.027 C 40.708 33.627 40.298 28.027 41.648 26.547 C 41.755 26.416 41.92 26.348 42.088 26.367 C 44.788 26.367 47.088 32.197 47.738 40.537 C 47.788 41.207 47.868 42.047 47.968 42.997 C 48.258 45.937 49.128 54.877 47.818 56.547 C 47.115 57.108 46.198 57.325 45.318 57.137 C 43.887 57.087 42.525 56.514 41.488 55.527 C 40.938 54.527 40.998 48.697 41.028 45.217 C 41.058 42.627 41.088 39.917 40.988 37.607 Z M 12.358 44.557 C 11.831 44.593 11.313 44.408 10.928 44.047 C 9.928 42.607 11.028 34.917 11.398 32.367 L 11.398 32.237 C 11.172 36.368 11.495 40.51 12.358 44.557 Z"/>
        <path d="M 13.873 27.852 H 19.405 V 38.569 H 30.469 V 43.929 H 19.405 V 54.647 H 13.873 V 43.929 H 2.809 V 38.569 H 13.873 Z" style="" bx:shape="cross 2.809 27.852 27.66 26.795 5.36 5.532 0.5 1@67777636"/>
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
