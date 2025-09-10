<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2020 - 2025 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/


// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Form\FormHelper;
use Joomla\CMS\HTML\HTMLHelper;

FormHelper::loadFieldClass('list');

/**
 * JTrax Form Field class for the JTrax component
 *
 * @since  0.0.1
 */
 
class ComponentsJtraxField extends ListField
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'JTrax';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of HTMLHelper options.
	 */
	protected function getOptions()
	{
		$db    = Factory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,code,status_id,datetime,status,notes');
		$query->from('#__jtrax');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();

		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = HTMLHelper::_('select.option', $message->id, $message->code, $message->datetime, $message->status);
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
