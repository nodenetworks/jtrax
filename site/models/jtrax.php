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

    /**
     * Get list of available statuses for frontend select
     *
     * @return array List of status objects with id and title
     */
    public function getStatuses()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select($db->quoteName(['id', 'title']))
            ->from($db->quoteName('#__jtrax_statuses'))
            ->order($db->quoteName('title') . ' ASC');

        $db->setQuery($query);

        return $db->loadObjectList();
    }

    /**
     * Save status and optional notes for an item
     *
     * @param   array  $data  Associative array with keys: id, status_id, notes (optional)
     * @return  boolean True on success
     */
    public function saveItem($data)
    {
        $db = $this->getDbo();

        $id = (int) ($data['id'] ?? 0);
        if ($id === 0) {
            return false;
        }

        $statusId = isset($data['status_id']) ? (int) $data['status_id'] : 0;

        // Fetch status title for the status_id
        $statusTitle = '';
        if ($statusId > 0) {
            $sQuery = $db->getQuery(true)
                ->select($db->quoteName('title'))
                ->from($db->quoteName('#__jtrax_statuses'))
                ->where($db->quoteName('id') . ' = ' . $statusId);
            $db->setQuery($sQuery);
            $statusTitle = $db->loadResult();
        }

        $fields = [];
        $fields[] = $db->quoteName('status_id') . ' = ' . $db->quote($statusId);
        // Save the human-readable text into the 'status' column (live DB column)
        $fields[] = $db->quoteName('status') . ' = ' . $db->quote($statusTitle);

        if (isset($data['notes'])) {
            $fields[] = $db->quoteName('notes') . ' = ' . $db->quote($data['notes']);
        }

        $query = $db->getQuery(true)
            ->update($db->quoteName('#__jtrax'))
            ->set($fields)
            ->where($db->quoteName('id') . ' = ' . $id);

        $db->setQuery($query);

        try {
            $db->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}