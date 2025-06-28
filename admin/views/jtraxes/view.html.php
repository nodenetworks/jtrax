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

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Document\Document;

/**
 * View class for the list of JTrax items.
 */
class JTraxViewJtraxes extends HtmlView
{
    public $items;
    public $pagination;
    public $state;
    public $filterForm;
    public $activeFilters;

    /**
     * Display the view
     *
     * @param string|null $tpl The name of the template file to parse
     * @return void
     */
    public function display($tpl = null): void
    {
        // Get data from the model
        $this->items          = $this->get('Items');
        $this->pagination     = $this->get('Pagination');
        $this->state          = $this->get('State');
        $this->filterForm     = $this->get('FilterForm');
        $this->activeFilters  = $this->get('ActiveFilters');

        // Check for errors
        if ($errors = $this->get('Errors')) {
            foreach ($errors as $error) {
                Factory::getApplication()->enqueueMessage($error, 'error');
            }
        }

        // Add the toolbar
        $this->addToolBar();

        // Display the template
        parent::display($tpl);

        // Set the document title
        $this->setDocument(Factory::getDocument());
    }

    /**
     * Configure the toolbar
     *
     * @return void
     */
    protected function addToolBar(): void
    {
        $title = Text::_('COM_JTRAX_TITLE_MAIN');

        if ($this->pagination->total) {
            $title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
        }

        ToolbarHelper::title($title, 'jtrax');
        ToolbarHelper::addNew('jtrax.add');
        ToolbarHelper::editList('jtrax.edit');
        ToolbarHelper::deleteList('', 'jtraxes.delete');
        ToolbarHelper::preferences('com_jtrax');
    }

    /**
     * Set the document title
     *
     * @param Document $document
     * @return void
     */
    public function setDocument(Document $document): void
    {
        $document->setTitle(Text::_('COM_JTRAX_TITLE_MAIN'));
    }
}