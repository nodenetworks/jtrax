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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::_('bootstrap.modal');
?>

<!-- Intro text -->
<p><?php echo htmlspecialchars($this->params->get('introtext', Text::_('COM_JTRAX_SEARCH_INTRO_TEXT')), ENT_QUOTES, 'UTF-8'); ?></p>

<!-- Where to find link -->

<?php
$wheretofindtext = $this->params->get('wheretofindtext', '');
if (empty($wheretofindtext)) {
    $wheretofindtext = Text::_('COM_JTRAX_SEARCH_WHERE_TO_FIND');
}

$wheretofindimage = $this->params->get('wheretofindimage', 'media/com_jtrax/images/wheretofind.jpg');
?>
<?php if ($this->params->get('wheretofind', '1') == 1): ?>
<p>
    <a href="#wheretofindModal" data-bs-toggle="modal">
        <?php echo htmlspecialchars($wheretofindtext, ENT_QUOTES, 'UTF-8'); ?>
    </a>
</p>

<div class="modal fade" id="wheretofindModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo htmlspecialchars($wheretofindtext, ENT_QUOTES, 'UTF-8'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo Text::_('JTOOLBAR_CLOSE'); ?>"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo htmlspecialchars($wheretofindimage, ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($wheretofindtext, ENT_QUOTES, 'UTF-8'); ?>" />
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Search form -->
<form name="searchForm" action="<?php echo Route::_('index.php?option=com_jtrax&view=jtrax'); ?>" method="get">
    <?php echo HTMLHelper::_('form.token'); ?>
    <?php echo htmlspecialchars($this->params->get('label', Text::_('COM_JTRAX_SEARCH_LABEL')), ENT_QUOTES, 'UTF-8'); ?>
    <input type="text" name="code" maxlength="31" value="<?php echo htmlspecialchars($this->searchterm ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
    <input type="submit" value="<?php echo htmlspecialchars($this->params->get('button', Text::_('COM_JTRAX_SEARCH_BUTTON')), ENT_QUOTES, 'UTF-8'); ?>" />
</form>

<!-- Results -->
<?php if (!empty($this->information)) : ?>
    <p><?php echo Text::_('COM_JTRAX_RESULTS_FOR') . ' ' . htmlspecialchars($this->searchterm, ENT_QUOTES, 'UTF-8'); ?></p>

    <table class="results" style="width:100%">
        <thead>
            <tr>
                <th style="width:30%"><?php echo Text::_('COM_JTRAX_RESULTS_DATE'); ?></th>
                <th><?php echo Text::_('COM_JTRAX_RESULTS_STATUS'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->information as $el) :
                $date = new DateTime($el->datetime);
            ?>
                <tr>
                    <td class="time" style="width:30%"><?php echo $date->format('d/m/Y'); ?></td>
                    <td class="status"><?php echo htmlspecialchars($el->status, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif (isset($this->searchterm) && $this->searchterm !== '') : ?>
    <p><?php echo Text::_('COM_JTRAX_NO_RESULTS'); ?></p>
<?php endif; ?>
