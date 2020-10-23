<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_jtrax
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Tags helper.
 *
 * @since       3.1
 * @deprecated  4.0
 */
class JTraxHelper extends JHelperContent
{
	/**
	 * Configure the Submenu links.
	 *
	 * @param   string  $extension  The extension.
	 *
	 * @return  void
	 *
	 * @since       3.1
	 * @deprecated  4.0
	 */
	public static function addSubmenu($extension)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_JTRAX_SUBMENU_JTRAXES'),
			'index.php?option=com_jtrax',
			$submenu == 'jtraxes'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_JTRAX_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&view=categories&extension=com_jtrax',
			$submenu == 'categories'
		);

		// Set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-jtrax ' .
										'{background-image: url(../media/com_jtrax/images/logojtrax.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_JTRAX_ADMINISTRATION_CATEGORIES'));
		}
	}
}
