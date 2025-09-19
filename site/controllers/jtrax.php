<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

class JtraxControllerJtrax extends BaseController
{
    /**
     * Save status and optional notes for an item (frontend)
     *
     * @return bool
     */
    public function save()
    {
        // CSRF check
        Session::checkToken() or die(Text::_('JINVALID_TOKEN'));

        $app = Factory::getApplication();
        $input = $app->input;

        $data = [
            'id' => $input->getInt('id'),
            'status_id' => $input->getInt('status_id'),
            'notes' => $input->getString('notes', '')
        ];

        $model = $this->getModel('Jtrax');

        if (!$model) {
            $app->enqueueMessage(Text::_('COM_JTRAX_SAVE_FAILED'), 'error');
            $this->setRedirect(Route::_('index.php?option=com_jtrax'));
            return false;
        }

        $saved = $model->saveItem($data);

        if ($saved) {
            $app->enqueueMessage(Text::_('COM_JTRAX_SAVE_SUCCESS'));
        } else {
            $app->enqueueMessage(Text::_('COM_JTRAX_SAVE_FAILED'), 'error');
        }

        // Redirect back to referrer or component home
        $ref = $input->server->getString('HTTP_REFERER', Route::_('index.php?option=com_jtrax'));
        $this->setRedirect($ref);

        return $saved;
    }
}
