<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2020 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
?>
<form action="index.php?option=com_jtrax&view=jtraxes" method="post" id="adminForm" name="adminForm">
	<div class="item-fluid">
		<div class="span6">
			<?php echo JText::_('COM_JTRAX_JTRAXES_FILTER'); ?>
			<?php
				echo JLayoutHelper::render(
					'joomla.searchtools.default',
					array('view' => $this)
				);
			?>
		</div>
	</div>
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo JText::_('COM_JTRAX_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="10%">
				<?php echo JHtml::_('grid.sort', 'COM_JTRAX_LABEL_CODE', 'status', $listDirn, $listOrder);?>
			</th>
			<th width="10%">
				<?php echo JHtml::_('grid.sort', 'COM_JTRAX_LABEL_DATE', 'datetime', $listDirn, $listOrder);?>
			</th>
			<th width="85%">
				<?php echo JHtml::_('grid.sort', 'COM_JTRAX_LABEL_STATUS', 'status', $listDirn, $listOrder);?>
			</th>
			<th width="5%">
				<?php echo JHtml::_('grid.sort', 'COM_JTRAX_PUBLISHED', 'published', $listDirn, $listOrder); ?>
			</th>
			<th width="2%">
				<?php echo JHtml::_('grid.sort', 'COM_JTRAX_ID', 'id', $listDirn, $listOrder); ?>
			</th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $item) :
					$link = JRoute::_('index.php?option=com_jtrax&task=jtrax.edit&id=' . $item->id);
				?>
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_JTRAX_EDIT_JTRAX'); ?>">
								<?php echo $item->code; ?>
							</a>
						</td>
						<td>
							<?php echo $item->datetime; ?>
						</td>
						<td>
							<?php echo $item->status; ?>
						</td>
						<td align="center">
							<?php echo JHtml::_('jgrid.published', $item->published, $i, 'jtraxes.', true, 'cb'); ?>
						</td>
						<td align="center">
							<?php echo $item->id; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>

