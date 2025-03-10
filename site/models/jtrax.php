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

use Joomla\CMS\Factory;

class JTraxModelJTrax extends JModelItem
{
	protected $searchterm;
 	public function getSearchterm() 
	{
		$jinput = Factory::getApplication()->input;
		$this->searchterm = $jinput->get('code','','STRING');
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
	public function getItem($pk = null)
{
    $pk = (!empty($pk)) ? $pk : (int) $this->getState('jtrax.id');

    if ($pk === 0) {
        return false; // No valid primary key
    }

    // Load the item from the database
    $db = $this->getDbo();
    $query = $db->getQuery(true)
        ->select('*')
        ->from($db->quoteName('#__jtrax'))
        ->where($db->quoteName('id') . ' = ' . (int) $pk);
    $db->setQuery($query);

    $item = $db->loadObject();

    if (!$item) {
        throw new Exception('Item not found', 404);
}