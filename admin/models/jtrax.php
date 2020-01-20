<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2020 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');
//jimport('joomla.application.component.modeladmin');
 
class JTraxModelJTrax extends JModelAdmin
{
	public function getTable($type = 'JTrax', $prefix = 'JTraxTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
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