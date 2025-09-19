<?php
/*------------------------------------------------------------------------
 # JTrax
 # ------------------------------------------------------------------------
 # author    Michał Ostrykiewicz
 # copyright Copyright (C) 2025 Michał Ostrykiewicz. All rights reserved.
 # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Technical Support:  https://github.com/nodenetworks/jtrax/
 -------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

class JtraxModelStatus extends AdminModel
{
    public function getTable($type = 'Status', $prefix = 'JtraxTable', $config = [])
    {
        return parent::getTable($type, $prefix, $config);
    }

    public function getForm($data = [], $loadData = true)
    {
        $form = $this->loadForm('com_jtrax.status', 'status', ['control' => 'jform', 'load_data' => $loadData]);

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = $this->getItem();
        return $data;
    }
}
