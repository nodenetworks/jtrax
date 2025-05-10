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
//jimport('joomla.application.component.modeladmin');

use \Joomla\CMS\MVC\Model\AdminModel;
use \Joomla\CMS\Table\Table;
{
	public function getTable($type = 'JTrax', $prefix = 'JTraxTable', $config = array()) 
	{
		return Table::getInstance($type, $prefix, $config);
	}
	public function getForm($data = array(), $loadData = true) 
	{
		$form = $this->loadForm(
			'com_jtrax.jtrax',
			'jtrax',
		    array(
			'control' => 'jform',
			'load_data' => $loadData
			)
		);
		
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}
		
	protected function loadFormData() 
	{
		$data = JFactory::getApplication()->getUserState(
		'com_jtrax.edit.jtrax.data',
		array()
		);
		
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
}