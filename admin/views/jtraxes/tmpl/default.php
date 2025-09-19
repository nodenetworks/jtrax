<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2020-2025 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

							   
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

?>

<form action="<?php echo Route::_('index.php?option=com_jtrax&view=jtraxes'); ?>" method="post" name="adminForm" id="adminForm">

    <?php if (!empty($this->sidebar)) : ?>
        <div id="j-sidebar-container" class="col-md-2">
            <?php echo $this->sidebar; ?>
        </div>
        <div id="j-main-container" class="col-md-10">
    <?php else : ?>
        <div id="j-main-container">
    <?php endif; ?>

        <?php
        // Joomla 4/5 search tools layout
        echo LayoutHelper::render('joomla.searchtools.default', [
            'view' => $this
        ]);
        ?>

        <table class="table table-striped" id="jtraxList">
            <thead>
                <tr>
                    <th width="1%"><?php echo HTMLHelper::_('grid.checkall'); ?></th>
                    <th width="10%"><?php echo HTMLHelper::_('searchtools.sort', 'COM_JTRAX_FIELD_CODE', 'a.code', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
                    <th width="10%"><?php echo HTMLHelper::_('searchtools.sort', 'COM_JTRAX_FIELD_DATE', 'a.datetime', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
					<th width="20%"><?php echo HTMLHelper::_('searchtools.sort', 'COM_JTRAX_FIELD_STATUS', 'a.status_title', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
                    <th width="20%"><?php echo HTMLHelper::_('searchtools.sort', 'COM_JTRAX_FIELD_DETAILS', 'a.details', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
					<th width="45%"><?php echo Text::_('COM_JTRAX_FIELD_NOTES'); ?></th>
					<th width="5%"><?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
					<th width="1%"><?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr>
                        <td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
                        <td>
                            <a href="<?php echo Route::_('index.php?option=com_jtrax&task=jtrax.edit&id=' . (int) $item->id); ?>">
                                <?php echo $this->escape($item->code); ?>
                            </a>
                        </td>
                        <td><?php echo $this->escape($item->datetime); ?></td>
						<!-- Status (join query needed in model for text) -->
						<td><?php echo htmlspecialchars($item->status_title ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
						<td><?php echo $this->escape($item->details); ?></td>
						<td><?php echo htmlspecialchars(Joomla\CMS\HTML\Helpers\StringHelper::truncate($item->notes, 50), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'jtraxes.', true, 'cb'); ?></td>
                        <td><?php echo (int) $item->id; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php echo $this->pagination->getListFooter(); ?>
        <?php echo $this->pagination->getResultsCounter(); ?>

        <input type="hidden" name="task" value="">
        <input type="hidden" name="boxchecked" value="0">
        <?php echo HTMLHelper::_('form.token'); ?>
    </div>
</form>