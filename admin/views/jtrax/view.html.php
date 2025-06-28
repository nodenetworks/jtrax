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
 * View class for editing a JTrax item.
 */
class JTraxViewJtrax extends HtmlView
{
    public $form;
    public $item;

    /**
     * Display the view
     *
     * @param string|null $tpl The name of the template file to parse
     * @return void
     */
    public function display($tpl = null): void
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        // Check for errors
        if ($errors = $this->get('Errors')) {
            foreach ($errors as $error) {
                Factory::getApplication()->enqueueMessage($error, 'error');
            }
        }

        $this->addToolBar();
        parent::display($tpl);
        $this->setDocument(Factory::getDocument());
    }

    /**
     * Configure the toolbar
     *
     * @return void
     */
    protected function addToolBar(): void
    {
        $input = Factory::getApplication()->input;

        // Hide main menu in Joomla admin
        $input->set('hidemainmenu', true);

        $isNew = empty($this->item->id);

        ToolbarHelper::title(
            $isNew ? Text::_('COM_JTRAX_TITLE_NEW') : Text::_('COM_JTRAX_TITLE_EDIT'),
            'jtrax'
        );

        ToolbarHelper::apply('jtrax.apply');
        ToolbarHelper::save('jtrax.save');
        ToolbarHelper::save2new('jtrax.save2new');
        ToolbarHelper::cancel('jtrax.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }

    /**
     * Set the document title
     *
     * @param Document $document
     * @return void
     */
    public function setDocument(Document $document): void
    {
        $isNew = empty($this->item->id);

        $document->setTitle(
            $isNew ? Text::_('COM_JTRAX_TITLE_NEW') : Text::_('COM_JTRAX_TITLE_EDIT')
        );
    }
}