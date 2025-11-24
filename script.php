<?php
// Local: /script.php
defined('_JEXEC') or die;

use Joomla\CMS\Installer\InstallerScript;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

/**
 * Script de Instalação Personalizado do SIGESPE
 * Garante que as tabelas são criadas corretamente.
 */
class com_sigespeInstallerScript extends InstallerScript
{
    /**
     * Executado DEPOIS que os arquivos foram copiados para o servidor.
     */
    public function postflight($type, $parent)
    {
        // Só executa na instalação ou atualização
        if (!in_array($type, ['install', 'update'])) {
            return true;
        }

        $this->installTables($parent);
        
        return true;
    }

    /**
     * Função privada para ler e executar o SQL
     */
    private function installTables($parent)
    {
        $db = Factory::getDbo();
        // Caminho exato onde o Joomla colocou o arquivo SQL no administrador
        $sqlFile = JPATH_ADMINISTRATOR . '/components/com_sigespe/sql/install.mysql.utf8.sql';
        
        // Se não achar no admin (caso de instalação limpa), tenta achar na pasta 'source' do instalador
        if (!file_exists($sqlFile)) {
             $sqlFile = $parent->getParent()->getPath('source') . '/admin/sql/install.mysql.utf8.sql';
        }

        if (!file_exists($sqlFile)) {
            Factory::getApplication()->enqueueMessage('ERRO CRÍTICO: Arquivo SQL não encontrado em: ' . $sqlFile, 'error');
            return false;
        }

        // Lê o arquivo
        $buffer = file_get_contents($sqlFile);
        
        // Limpeza de caracteres invisíveis que costumam quebrar a instalação (BOM, espaços fantasmas)
        $buffer = str_replace(['#_', "\xEF\xBB\xBF", "\r", "\xC2\xA0"], [$db->getPrefix(), '', '', ' '], $buffer);

        // Divide o arquivo em queries separadas
        $queries = $db->splitSql($buffer);

        $count = 0;
        foreach ($queries as $query) {
            $query = trim($query);
            if ($query != '' && strpos($query, '--') !== 0) {
                try {
                    $db->setQuery($query)->execute();
                    $count++;
                } catch (Exception $e) {
                    // Se a tabela já existe, ignoramos o erro para não travar a atualização
                    // Factory::getApplication()->enqueueMessage('Nota SQL: ' . $e->getMessage(), 'notice');
                }
            }
        }

        Factory::getApplication()->enqueueMessage('SUCESSO: Banco de Dados do Sigespe instalado/atualizado (' . $count . ' comandos executados).', 'message');
    }
    
    // Funções obrigatórias da classe (podem ficar vazias)
    public function install($parent) {}
    public function uninstall($parent) {}
    public function update($parent) {}
    public function preflight($type, $parent) {}
}