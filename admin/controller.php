<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2020 Michał Ostrykiewicz. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

class JTraxController extends JControllerLegacy
{
	protected $default_view = 'jtraxes';
		
	function display($cachable = false, $urlparams = false) 
	{
		parent::display($cachable);
	}
}
