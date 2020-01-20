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
//jimport('joomla.application.component.view');

class JtraxViewJTraxes extends JViewLegacy
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
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}
		

		$this->addToolBar();

		parent::display($tpl);
		
		$this->setDocument();
	}
	protected function addToolBar() 
	{
		$title = JText::_('COM_JTRAX_TITLE_MAIN');

		if ($this->pagination->total)
		{
			$title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
		}

		JToolBarHelper::title($title, 'jtrax');
		JToolBarHelper::addNew('jtrax.add');
		JToolBarHelper::editList('jtrax.edit');
		JToolBarHelper::deleteList('','jtraxes.delete'); 
		JToolBarHelper::preferences('com_jtrax');
	}
	
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle('JTrax');
	}
}