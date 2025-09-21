<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2025 Michał Ostrykiewicz. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class com_jtraxInstallerScript
{
    /**
     * Method to run after an install/update/uninstall method
     *
     * @param string $type The type of change (install, update or discover_install)
     * @param object $parent The class calling this method
     */
    public function postflight($type, $parent)
    {
        $app = Factory::getApplication();

        if ($type === 'install') {
            $app->enqueueMessage(Text::_('COM_JTRAX_INSTALLATION_SUCCESSFUL'), 'message');
        }

        if ($type === 'update') {
            $app->enqueueMessage(Text::_('COM_JTRAX_UPDATE_SUCCESSFUL'), 'message');
        }
    }
}
