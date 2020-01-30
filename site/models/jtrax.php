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

defined('_JEXEC') or die('Restricted access');

class JTraxModelJTrax extends JModelItem
{
	protected $searchterm;
 	public function getSearchterm() 
	{
		$this->searchterm =  JRequest::getVar('code','','POST','STRING');
		return $this->searchterm;
	}
	
	protected $information;
 	public function getInformation() 
	{
		$db =JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('*');
		$query->from('#__jtrax');
		$query->where('code = "'.$this->searchterm.'"')
		      ->where('published = "1"');
		$db->setQuery($query);
		$this->information = $db->loadObjectList();
		return $this->information;
	}
}