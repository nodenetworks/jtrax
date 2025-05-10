<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2020-2025 Michał Ostrykiewicz. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');
use \Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

//$document = JFactory::getDocument();
//$document->addStyleDeclaration('.icon-48-generic {background-image: url(../media/com_jtrax/images/logojtrax.png);}');
//$document->addStyleDeclaration('.icon-48-jtrax {background-image: url(../media/com_jtrax/images/logojtrax.png);}');

//jimport('joomla.application.component.controller');

$controller = BaseController::getInstance('JTrax');

$input = Factory::getApplication()->input;
$controller->execute($input->getCmd('task'));
$controller->redirect();
