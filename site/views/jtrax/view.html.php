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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class JtraxViewJtrax extends BaseHtmlView
{
    protected $item;
    public $params;
    public $pageclass_sfx = '';
    public $searchterm;
    public $information = 0;
    public $open = true;
    public $openingtime;
    public $closingtime;

    public function display($tpl = null)
    {
        $app = Factory::getApplication();
		
		// Load component parameters
		$this->params = $app->getParams();

        HTMLHelper::_('bootstrap.modal'); // Load modal behavior

        // Load the model data BEFORE calling parent::display()
        $this->item   = $this->get('Item');

        // Load component params
        $this->params = $app->getParams();
        $this->pageclass_sfx = htmlspecialchars($this->params->get('pageclass_sfx', ''));

        // Initialize variables
        $this->searchterm = $this->get('searchterm');
		$this->information = $this->get('Information');
        //$this->information = 0;
        $this->open = true;

        // Example logic with timetable
        if ($this->params->get('timetable', '0') != 0) {
            $this->openingtime = $this->params->get('openingtime', 1);
            $this->closingtime = $this->params->get('openingtime', 1) + $this->params->get('duration', 12);

            if ($this->closingtime > 24) {
                $this->closingtime = $this->closingtime - 24;
            }

            if ($this->openingtime > $this->closingtime) {
                if (date("H") >= $this->closingtime && date("H") < $this->openingtime) {
                    $this->open = false;
                }
            } else {
                if (date("H") >= $this->closingtime || date("H") < $this->openingtime) {
                    $this->open = false;
                }
            }
        }

        if ($this->open == false) {
            $error = $this->params->get('errClose', Text::_('COM_JTRAX_ERROR_CLOSED'));
            $app->enqueueMessage($error, 'error');
            $this->information = 0;
        } elseif (!empty($this->searchterm)) {
            if (!preg_match("/^[a-z0-9]{4,31}$/i", $this->searchterm)) {
                $error = $this->params->get('errInvalid', '"' . $this->searchterm . '" ' . Text::_('COM_JTRAX_ERROR_INVALID_CODE'));
                $app->enqueueMessage($error, 'error');
                $this->information = 0;
            } else {
				// Load the model data
                $this->information = $this->get('information');
				$this->searchterm  = $this->get('Searchterm');
                if ($this->information === null || $this->information === '') {
                    Session::checkToken() or die('Invalid Token');
                    $error = Text::_('COM_JTRAX_ERROR_NO_RESULTS_PREPEND') . $this->searchterm . Text::_('COM_JTRAX_ERROR_NO_RESULTS_APPEND');
                    $app->enqueueMessage($error, 'notice');
                    $this->information = 0;
                }
            }

            if (count($errors = $this->get('Errors'))) {
                Log::add(implode('<br />', $errors), Log::WARNING, 'jerror');
                return false;
            }
        }

        // Call parent display
        parent::display($tpl);
    }
}
