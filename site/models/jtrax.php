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

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ItemModel;

class JtraxModelJtrax extends ItemModel
{
    protected $searchterm;

    // Get search term from input
    public function getSearchterm() 
    {
        $app = Factory::getApplication();
        $this->searchterm = $app->input->getString('code', ''); // match your frontend form input name
        return $this->searchterm;
    }

    // Get information based on search term
    public function getInformation() 
    {
        // Make sure searchterm is set
        $search = $this->getSearchterm();
        if (empty($search)) {
            return [];
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
              ->from($db->quoteName('#__jtrax'))
              ->where($db->quoteName('code') . ' = ' . $db->quote($search))
              ->where($db->quoteName('published') . ' = 1');

        $db->setQuery($query);

        return $db->loadObjectList();
    }

    public function getItem($pk = null)
    {
        $pk = (!empty($pk)) ? $pk : (int) $this->getState('jtrax.id');

        if ($pk === 0) {
            return false;
        }

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

        return $item;
    }
}