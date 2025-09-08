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

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<form action="index.php?option=com_jtrax&view=jtraxes" method="post" name="adminForm" id="adminForm">

    <?php echo $this->filterForm->renderFieldset('filter'); ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th width="1%"><?php echo HTMLHelper::_('grid.checkall'); ?></th>
                <th width="10%">
                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_JTRAX_LABEL_CODE', 'a.code', $listDirn, $listOrder); ?>
                </th>
                <th width="15%">
                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_JTRAX_LABEL_DATE', 'a.datetime', $listDirn, $listOrder); ?>
                </th>
                <th width="20%">
                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_JTRAX_LABEL_STATUS', 'a.status', $listDirn, $listOrder); ?>
                </th>
                <th width="5%">
                    <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
                </th>
                <th width="2%">
                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->items as $i => $item) : ?>
                <tr>
                    <td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
                    <td><?php echo $this->escape($item->code); ?></td>
                    <td><?php echo $this->escape($item->datetime); ?></td>
                    <td><?php echo $this->escape($item->status); ?></td>
                    <td class="center">
                        <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'jtraxes.', true, 'cb'); ?>
                    </td>
                    <td><?php echo (int) $item->id; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
    </table>

    <input type="hidden" name="task" value="">
    <input type="hidden" name="boxchecked" value="0">
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>">
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
