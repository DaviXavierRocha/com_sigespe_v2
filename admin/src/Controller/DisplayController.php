<?php
namespace Sigespe\Component\Sigespe\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{
    // Define a view padrão para quando abrir o componente
    protected $default_view = 'visao_corporativa';

    public function display($cachable = false, $urlparams = false)
    {
        return parent::display($cachable, $urlparams);
    }
}