<?php
/*------------------------------------------------------------------------
 # JTrax
 # ------------------------------------------------------------------------
 # author    Michał Ostrykiewicz
 # copyright Copyright (C) 2025 Michał Ostrykiewicz. All rights reserved.
 # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Technical Support:  https://github.com/nodenetworks/jtrax/
 -------------------------------------------------------------------------*/

// No direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Table\Table;

class JtraxTableStatus extends Table
{
    public $id = 0;
    public $title = '';
    public $published = 1;

    public function __construct(&$db)
    {
        parent::__construct('#__jtrax_statuses', 'id', $db);
    }
}
