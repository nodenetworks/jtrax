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
//jimport('joomla.application.component.view');

use \Joomla\CMS\MVC\View\HtmlView;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;
{
	function display($tpl = null) 
	{
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			foreach($errors as $error) {
				Factory::getApplication()->enqueueMessage($error, 'error');
			}
		}

		$this->addToolBar();

		parent::display($tpl);
		
		$this->setDocument();
	}
	protected function addToolBar() 
	{
		$title = Text::_('COM_JTRAX_TITLE_MAIN');

		if ($this->pagination->total)
		{
			$title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
		}

		ToolBarHelper::title($title, 'jtrax');
		ToolBarHelper::addNew('jtrax.add');
		ToolBarHelper::editList('jtrax.edit');
		ToolBarHelper::deleteList('','jtraxes.delete'); 
		ToolBarHelper::preferences('com_jtrax');
	}
	
	protected function setDocument() 
	{
		$document = Factory::getDocument();
		$document->setTitle('JTrax');
	}
}