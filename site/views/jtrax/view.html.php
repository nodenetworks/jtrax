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
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Log\Log;

class JtraxViewJtrax extends BaseHtmlView
{
    public $params;
    public $searchterm;
    public $information = [];
    public $pageclass_sfx = '';
    public $open = true;
    public $openingtime;
    public $closingtime;

    public function display($tpl = null)
    {
        $app = Factory::getApplication();

        // Load component parameters
        $this->params = $app->getParams();
        $this->pageclass_sfx = htmlspecialchars($this->params->get('pageclass_sfx', ''), ENT_QUOTES, 'UTF-8');

        // Load the search term from input
        $input = $app->input;
        $this->searchterm = $input->getString('code', '');

        // Initialize information array
        $this->information = [];

        // Check timetable if applicable
        if ((int)$this->params->get('timetable', 0) !== 0) {
            $this->openingtime = (int)$this->params->get('openingtime', 1);
            $this->closingtime = $this->openingtime + (int)$this->params->get('duration', 12);
            if ($this->closingtime > 24) {
                $this->closingtime -= 24;
            }

            $hour = (int)date('H');
            if ($this->openingtime > $this->closingtime) {
                if ($hour >= $this->closingtime && $hour < $this->openingtime) {
                    $this->open = false;
                }
            } else {
                if ($hour >= $this->closingtime || $hour < $this->openingtime) {
                    $this->open = false;
                }
            }
        }

        if (!$this->open) {
            $error = $this->params->get('errClose', Text::_('COM_JTRAX_ERROR_CLOSED'));
            $app->enqueueMessage($error, 'error');
        } elseif (!empty($this->searchterm)) {
            // Validate the search term
            if (!preg_match("/^[a-z0-9]{4,31}$/i", $this->searchterm)) {
                $error = $this->params->get('errInvalid', '"' . $this->searchterm . '" ' . Text::_('COM_JTRAX_ERROR_INVALID_CODE'));
                $app->enqueueMessage($error, 'error');
            } else {
                // Load model and get information
                $model = $this->getModel();
                if ($model) {
                    $this->information = $model->getInformation($this->searchterm);
                }

                if (empty($this->information)) {
                    Session::checkToken() or die('Invalid Token');
                    $error = Text::_('COM_JTRAX_ERROR_NO_RESULTS_PREPEND') . ' "' . $this->searchterm . '" ' . Text::_('COM_JTRAX_ERROR_NO_RESULTS_APPEND');
                    $app->enqueueMessage($error, 'notice');
                }
            }

            // Check for errors from the model
            if (count($errors = $this->get('Errors'))) {
                Log::add(implode('<br />', $errors), Log::WARNING, 'jerror');
                return false;
            }
        }

        // Call parent display
        parent::display($tpl);
    }
}
