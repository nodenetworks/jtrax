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

use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.multiselect');

?>

<form action="<?php echo Route::_('index.php?option=com_jtrax&view=statuses'); ?>" method="post" name="adminForm" id="adminForm">
    <h1><?php echo Text::_('COM_JTRAX_STATUSES_HEADING'); ?></h1>

    <?php if (!empty($this->sidebar)) : ?>
        <div id="j-sidebar-container" class="col-md-2">
            <?php echo $this->sidebar; ?>
        </div>
        <div id="j-main-container" class="col-md-10">
    <?php else : ?>
        <div id="j-main-container">
    <?php endif; ?>

    <?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>

    <table class="table table-striped" id="jtraxStatuses">
        <thead>
            <tr>
                <th width="1"><?php echo HTMLHelper::_('grid.checkall'); ?></th>
                <th width="1%"><?php echo Text::_('JGRID_HEADING_ID'); ?></th>
                <th><?php echo HTMLHelper::_('searchtools.sort', 'COM_JTRAX_STATUS_TITLE_LABEL', 'a.title', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
                <th width="10%"><?php echo HTMLHelper::_('searchtools.sort', 'JPUBLISHED', 'a.published', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr>
                        <td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
                        <td><?php echo (int) $item->id; ?></td>
                        <td>
                            <a href="<?php echo Route::_('index.php?option=com_jtrax&task=status.edit&id=' . (int) $item->id); ?>">
                                <?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </td>
                        <td><?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'statuses.', true, 'cb'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4"><?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo $this->pagination->getListFooter(); ?>
    <?php echo $this->pagination->getResultsCounter(); ?>

    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo HTMLHelper::_('form.token'); ?>

    </div>
</form>