<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2020 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

/**
 * Jtraxs view class for the JTrax package.

 */
class JtraxViewJtraxes extends JViewLegacy
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed   A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
	{
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->state         = $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		// Preprocess the list of items to find ordering divisions.
		foreach ($this->items as &$item)
		{
			$this->ordering[$item->parent_id][] = $item->id;
		}


		// We don't need toolbar in the modal window.
		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();
		}

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since   3.1
	 */
	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = JHelperContent::getActions('com_jtrax');
		$user  = JFactory::getUser();

		// Get the toolbar object instance
		$bar = JToolbar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_JTRAX_TITLE_MAIN'), 'jtrax');

		if ($canDo->get('core.create'))
		{
			JToolbarHelper::addNew('tag.add');
		}

		if ($canDo->get('core.edit'))
		{
			JToolbarHelper::editList('tag.edit');
		}

		if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::publish('jtraxes.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('jtraxes.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolbarHelper::archiveList('jtraxes.archive');
		}

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::checkin('jtraxes.checkin');
		}

		if ($state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'jtraxes.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('jtraxes.trash');
		}

		if ($canDo->get('core.admin') || $canDo->get('core.options'))
		{
			JToolbarHelper::preferences('com_jtrax');
		}
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 */
	protected function getSortFields()
	{
		return array(
			'a.published'   => JText::_('JSTATUS'),
			'a.code'    	=> JText::_('JGLOBAL_TITLE'),
			'a.status'   	=> JText::_('JGRID_HEADING_ACCESS'),
			'a.datetime' 	=> JText::_('JGRID_HEADING_LANGUAGE'),
			'a.id'       	=> JText::_('JGRID_HEADING_ID')
		);
	}
}
