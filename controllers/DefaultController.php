<?php
/**
 * OpenEyes
 *
 * (C) OpenEyes Foundation, 2016
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2016, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

namespace OEModule\OphCoCvi\controllers;

use OEModule\OphCoCvi\components\OphCoCvi_Manager;

class DefaultController extends \BaseEventTypeController
{
    protected $cvi_manager;

    const ACTION_TYPE_LIST = 'List';

    protected static $action_types = array(
        'list' => self::ACTION_TYPE_LIST
    );

    /**
     * Currently uses the OprnEditCvi operation to check for access
     * 
     * @return mixed
     */
    public function checkListAccess()
    {
        return $this->checkAccess('OprnEditCvi', $this->getApp()->user->id);
    }

    /**
     * @return OphCoCvi_Manager
     */
    public function getManager()
    {
        if (!isset($this->cvi_manager)) {
            $this->cvi_manager = new OphCoCvi_Manager($this->getApp());
        }

        return $this->cvi_manager;
    }

    /**
     * Generate a list of all the CVI events for clerical use.
     */
    public function actionList()
    {
        $this->layout = '//layouts/main';
        $this->renderPatientPanel = false;

        $filter = array(
            'date_from' => $this->request->getPost('date_from', null),
            'date_to' => $this->request->getPost('date_to', null),
            'consultant_ids' => $this->request->getPost('consultant_ids', null),
            'show_issued' => $this->request->getPost('show_issued', false)
        );

        $dp = $this->getManager()->getListDataProvider($filter);

        $this->render('list', array('dp' => $dp));
    }

}
