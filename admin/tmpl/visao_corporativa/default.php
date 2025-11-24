<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

// Carrega o CSS do Bootstrap (nativo do Joomla)
HTMLHelper::_('bootstrap.tooltip');
?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="page-title text-uppercase text-primary fw-bold">
                Visão Corporativa - Sigespe
            </h1>
            <p class="text-muted">Resumo do efetivo e estrutura do 3º BEC</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow-sm h-100">
                <div class="card-header fw-bold text-uppercase">Companhias</div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <h1 class="display-2 fw-bold mb-0"><?php echo $this->companhias; ?></h1>
                    <p class="card-text"><i class="fas fa-building"></i> Unidades Cadastradas</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3 shadow-sm h-100">
                <div class="card-header fw-bold text-uppercase">Seções</div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <h1 class="display-2 fw-bold mb-0"><?php echo $this->secoes; ?></h1>
                    <p class="card-text"><i class="fas fa-sitemap"></i> Subdivisões</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-dark bg-warning mb-3 shadow-sm h-100">
                <div class="card-header fw-bold text-uppercase">Militares</div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <h1 class="display-2 fw-bold mb-0"><?php echo $this->militares; ?></h1>
                    <p class="card-text"><i class="fas fa-users"></i> Efetivo Total</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3 shadow-sm h-100">
                <div class="card-header fw-bold text-uppercase">Pronto p/ Serviço</div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <h1 class="display-2 fw-bold mb-0"><?php echo $this->prontos; ?></h1>
                    <p class="card-text"><i class="fas fa-check-circle"></i> Disponíveis</p>
                </div>
            </div>
        </div>
    </div>
</div>