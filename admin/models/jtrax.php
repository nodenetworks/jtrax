<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2020 - 2025 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\AdminModel;

class JtraxModelJtrax extends AdminModel
{
    /**
     * Get the table
     *
     * @param   string $type   Table type
     * @param   string $prefix Table class prefix
     * @param   array  $config Configuration array
     *
     * @return  \Joomla\CMS\Table\Table
     */
    public function getTable($type = 'Jtrax', $prefix = 'JtraxTable', $config = array())
    {
        return parent::getTable($type, $prefix, $config);
    }

    /**
     * Get the form for editing/creating
     *
     * @param   array   $data      Data for the form
     * @param   boolean $loadData  Load the form data from the model state
     *
     * @return  \Joomla\CMS\Form\Form|false
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_jtrax.jtrax',
            'jtrax',
            array('control' => 'jform', 'load_data' => $loadData)
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Load form data
     *
     * @return  mixed  Data for the form
     */
    protected function loadFormData()
    {
        $data = $this->getItem();
        return $data;
    }
	
	/** Load statuses list for dropdown */
    public function getStatuses()
    {
		$db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('id AS value, title AS text')
            ->from($db->quoteName('#__jtrax_statuses'))
			->where($db->quoteName('published') . ' = 1')
            ->order('title ASC');
        $db->setQuery($query);

        return $db->loadObjectList();
    }
}
