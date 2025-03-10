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
JHTML::_('bootstrap.modal'); 
?>

<div class="jtrax<?php echo $this->pageclass_sfx; ?>">
<?php if ($this->open==TRUE){
	if ($this->information==0)
		echo $this->loadTemplate('form');
	else
		echo $this->loadTemplate('results');
} ?>
</div>
