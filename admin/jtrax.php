<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2020 Michał Ostrykiewicz. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tabstate');

//$document = JFactory::getDocument();
//$document->addStyleDeclaration('.icon-48-generic {background-image: url(../media/com_jtrax/images/logojtrax.png);}');
//$document->addStyleDeclaration('.icon-48-jtrax {background-image: url(../media/com_jtrax/images/logojtrax.png);}');

//jimport('joomla.application.component.controller');


// Access check: is this user allowed to access the backend of this component?
if (!JFactory::getUser()->authorise('core.manage', 'com_jtrax')) 
{
	throw new JAccessExceptionNotallowed(JText::_('JERROR_ALERTNOAUTHOR'), 403);
}

$controller = JControllerLegacy::getInstance('JTrax');

$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
$controller->redirect();
