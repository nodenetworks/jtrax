<?php
/*------------------------------------------------------------------------
 # JTrax
 # ------------------------------------------------------------------------
 # author    Michał Ostrykiewicz
 # copyright Copyright (C) 2025 Michał Ostrykiewicz. All rights reserved.
 # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Technical Support:  https://github.com/nodenetworks/jtrax/
 -------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

class JtraxModelStatuses extends ListModel
{
    public function __construct($config = [])
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = [
                'id', 'a.id',
                'title', 'a.title',
                'published', 'a.published',
            ];
        }

        parent::__construct($config);
    }

	protected function populateState($ordering = null, $direction = null)
    {
        $app = Factory::getApplication();

        // Load search filter
		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
        $this->setState('filter.published', $published);
        parent::populateState($ordering, $direction);
    }

    protected function getListQuery()
    {
        $db = $this->getDatabase();
        $query = $db->getQuery(true);

        // Select all columns and ensure a 'published' property exists (default to 1 if column missing)
        $query->select('a.*')
              ->select('COALESCE(a.published, 1) AS published')
              ->from($db->quoteName('#__jtrax_statuses', 'a'));

        // Apply search filter
		$search = $this->state->get('filter.search');
        if (!empty($search))
		{
            $search = '%' . $db->escape($search, true) . '%';
            $query->where('a.title LIKE ' . $db->quote($search));
        }

        // Apply published filter
        $published = $this->state->get('filter.published');
        if (is_numeric($published))
        {
            $query->where('a.published = ' . (int) $published);
        }
		// Ordering
        $orderCol  = $this->state->get('list.ordering', 'a.title');
        $orderDirn = $this->state->get('list.direction', 'ASC');
        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }
}