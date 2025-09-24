<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2020-2025 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

// Use the recommended way to get the controller instance in Joomla 4/5
$controller = Factory::getApplication()->bootComponent('com_jtrax')->getMVCFactory()->createController('Jtrax', 'site');

$input = Factory::getApplication()->input;
$controller->execute($input->getCmd('task'));
$controller->redirect();