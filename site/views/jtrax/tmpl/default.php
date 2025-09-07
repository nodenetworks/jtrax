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

// Extract parameters
$params = $this->params;

// Where-to-find text and image
$wheretofindtext = $params->get('wheretofindtext', Text::_('COM_JTRAX_SEARCH_WHERE_TO_FIND'));
$wheretofindimage = $params->get('wheretofindimage', 'media/com_jtrax/images/wheretofind.jpg');
?>

<!-- Intro text -->
<p><?php echo $params->get('introtext', Text::_('COM_JTRAX_SEARCH_INTRO_TEXT')); ?></p>

<!-- Where to find modal -->
<?php if ($params->get('wheretofind', '1') == 1): ?>
<p>
    <a href="#" data-bs-toggle="modal" data-bs-target="#wheretofindModal">
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
                <img src="<?php echo htmlspecialchars($wheretofindimage, ENT_QUOTES, 'UTF-8'); ?>" 
                     class="img-fluid" 
                     alt="<?php echo htmlspecialchars($wheretofindtext, ENT_QUOTES, 'UTF-8'); ?>" />
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Search form -->
<form name="input" action="<?php echo Route::_('index.php?option=com_jtrax'); ?>" method="post" class="mb-3">
    <?php echo HTMLHelper::_('form.token'); ?>
    <label for="code"><?php echo $params->get('label', Text::_('COM_JTRAX_SEARCH_LABEL')); ?></label>
    <input type="text" name="code" id="code" maxlength="31" value="<?php echo htmlspecialchars($this->searchterm ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control d-inline-block w-auto" />
    <input type="submit" value="<?php echo $params->get('button', Text::_('COM_JTRAX_SEARCH_BUTTON')); ?>" class="btn btn-primary" />
</form>

<!-- Search results -->
<?php if (!empty($this->information) && is_array($this->information)) : ?>
    <p><?php echo Text::_('COM_JTRAX_RESULTS_FOR') . ' ' . htmlspecialchars($this->searchterm, ENT_QUOTES, 'UTF-8'); ?></p>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo Text::_('COM_JTRAX_RESULTS_DATE'); ?></th>
                <th><?php echo Text::_('COM_JTRAX_RESULTS_STATUS'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->information as $el): ?>
                <tr>
                    <?php
                        $date = explode('-', $el->datetime);
                        $formattedDate = isset($date[2], $date[1], $date[0]) ? $date[2] . '/' . $date[1] . '/' . $date[0] : $el->datetime;
                    ?>
                    <td><?php echo $formattedDate; ?></td>
                    <td><?php echo htmlspecialchars($el->status, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
