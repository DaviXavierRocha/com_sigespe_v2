<?php
namespace Sigespe\Component\Sigespe\Administrator\View\Visao_corporativa;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView
{
    // Variáveis que vamos passar para o template
    protected $companhias;
    protected $secoes;
    protected $militares;
    protected $prontos;

    public function display($tpl = null)
    {
        // Conectar ao Banco de Dados
        $db = Factory::getContainer()->get('DatabaseDriver');

        // 1. Contar Companhias
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__sigespe_companhia'))
            ->where($db->quoteName('estado') . ' = 1');
        $db->setQuery($query);
        $this->companhias = (int) $db->loadResult();

        // 2. Contar Seções
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__sigespe_secao'))
            ->where($db->quoteName('estado') . ' = 1');
        $db->setQuery($query);
        $this->secoes = (int) $db->loadResult();

        // 3. Contar Militares
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__sigespe_militar'))
            ->where($db->quoteName('estado') . ' = 1');
        $db->setQuery($query);
        $this->militares = (int) $db->loadResult();

        // 4. Contar Militares "Pronto para Serviço"
        $query = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__sigespe_militar'))
            ->where($db->quoteName('estado') . ' = 1')
            ->where($db->quoteName('status') . ' = ' . $db->quote('Pronto para Serviço'));
        $db->setQuery($query);
        $this->prontos = (int) $db->loadResult();

        // Exibir o template
        parent::display($tpl);
    }
}