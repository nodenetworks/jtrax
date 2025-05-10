<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2025 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Language\Text;

HTMLHelper::_('bootstrap.modal');
?>
	<!-- search view -->
	<p><?php echo $this->params->get('introtext', Text::_('COM_JTRAX_SEARCH_INTRO_TEXT')); ?></p>
	<?php if($this->params->get('wheretofind','1')==1){ ?>
		<p>
			<a href="<?php echo $this->params->get('wheretofindimage','media/com_jtrax/images/wheretofind.jpg') ?>" class="modal">
				<?php echo $this->params->get('wheretofindtext',Text::_('COM_JTRAX_SEARCH_WHERE_TO_FIND')); ?>
			</a>
		</p>
	<?php }?> 
	<form name="input" action="<?php echo JRoute::_('index.php?option=com_jtrax'); ?>" method="post">
		<?php echo HTMLHelper::_( 'form.token' ); ?>
		<?php echo $this->params->get('label',Text::_('COM_JTRAX_SEARCH_LABEL')); ?> <input type="text" name="code" maxlength="31" />
		<input type="submit" value="<?php echo $this->params->get('button',Text::_('COM_JTRAX_SEARCH_BUTTON')); ?>" />
	</form>
