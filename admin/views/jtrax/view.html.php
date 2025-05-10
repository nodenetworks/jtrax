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
use Joomla\CMS\Language\Text;
{
	protected $form = null;

	public function display($tpl = null) 
	{
		$form = $this->get('Form');
		$item = $this->get('Item');
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			foreach($errors as $error) {
				Factory::getApplication()->enqueueMessage($error, 'error');
			}
		}
		
		$this->form = $form;
		$this->item = $item;
 
		$this->addToolBar();
 
		parent::display($tpl);
	
 
		// Set the document
		$this->setDocument();
	}
 
	protected function addToolBar() 
	{
		$input = Factory::getApplication()->input;
		// Hide Joomla Administrator Main menu
		$input->set('hidemainmenu', true);
		
		$user       = Factory::getUser();
		$isNew      = ($this->item->id == 0);
		//Enable once implemented
		//$checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		
		JToolBarHelper::title($isNew ? Text::_('COM_JTRAX_TITLE_NEW')
		                             : Text::_('COM_JTRAX_TITLE_EDIT'));
		JToolBarHelper::apply('jtrax.apply');
		JToolBarHelper::save('jtrax.save');
		JToolBarHelper::save2new('jtrax.save2new');
		JToolBarHelper::cancel('jtrax.cancel', $isNew ? 'JTOOLBAR_CANCEL'
		                                                   : 'JTOOLBAR_CLOSE');
	}
	protected function setDocument() 
	{
		$isNew = ($this->item->id < 1);
		$document = Factory::getDocument();
		$document->setTitle($isNew ? Text::_('COM_JTRAX_TITLE_NEW')
		                           : Text::_('COM_JTRAX_TITLE_EDIT'));
	}
}