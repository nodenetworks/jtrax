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
    /**
     * Get the search term from input
     *
     * @return string
     */
    public function getSearchterm()
    {
        $jinput = Factory::getApplication()->input;
        return $jinput->getString('code', '');
    }

    /**
     * Get information (tracking results) based on code
     *
     * @param string $code
     * @return array
     */
    public function getInformation($code = '')
    {
        if (empty($code)) {
            return [];
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__jtrax'))
            ->where($db->quoteName('code') . ' = ' . $db->quote($code))
            ->where($db->quoteName('published') . ' = 1');
        $db->setQuery($query);

        return $db->loadObjectList();
    }

    /**
     * Get a single item by primary key
     *
     * @param int $pk
     * @return object|false
     * @throws Exception
     */
    public function getItem($pk = null)
    {
        $pk = !empty($pk) ? (int)$pk : (int)$this->getState('jtrax.id');

        if ($pk === 0) {
            return false;
        }

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__jtrax'))
            ->where($db->quoteName('id') . ' = ' . (int)$pk);
        $db->setQuery($query);

        $item = $db->loadObject();

        if (!$item) {
            throw new Exception('Item not found', 404);
        }

        return $item;
    }
}