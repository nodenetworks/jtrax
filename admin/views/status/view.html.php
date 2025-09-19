<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2025 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\Document\Document;

class JtraxViewStatus extends HtmlView
{
    public $form;
    public $item;

    public function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        if ($errors = $this->get('Errors')) {
            foreach ($errors as $error) {
                Factory::getApplication()->enqueueMessage($error, 'error');
            }
        }

        $this->addToolbar();

        parent::display($tpl);
        $this->setDocument(Factory::getDocument());
    }

    protected function addToolbar()
    {
        $input = Factory::getApplication()->input;
        $input->set('hidemainmenu', true);

        $isNew = empty($this->item->id);

        ToolbarHelper::title($isNew ? Text::_('COM_JTRAX_STATUS_NEW') : Text::_('COM_JTRAX_STATUS_EDIT'), 'jtrax');
        ToolbarHelper::apply('status.apply');
        ToolbarHelper::save('status.save');
        ToolbarHelper::save2new('status.save2new');
        ToolbarHelper::cancel('status.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }

    public function setDocument(Document $document): void
    {
        $isNew = empty($this->item->id);
        $document->setTitle($isNew ? Text::_('COM_JTRAX_STATUS_NEW') : Text::_('COM_JTRAX_STATUS_EDIT'));
    }
}