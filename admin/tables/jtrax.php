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

use Joomla\CMS\Table\Table;

class JtraxTableJtrax extends Table
{
    public $id = 0;
	public $datetime = null;
    public $code = '';
	public $status_id = 0;   // foreign key to #__jtrax_statuses	
	public $status = '';
    public $notes = null;
    public $published = 1;
    
    public function __construct(&$db)
    {
        parent::__construct('#__jtrax', 'id', $db);
    }
}