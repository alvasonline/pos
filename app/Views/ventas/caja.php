<?= $this->extend('front/layout/main'); ?>
<?= $this->section('title') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
<?php $idVentaTmp = uniqid()?>
    <main>
        <form id="form_ventas" name="form_ventas" class="form-horizontal" method="POST" action="<?=base_url()?>/ventas/guarda" autocomplete="off">
        <input type="hidden" name="id_venta" id="id_venta" value="<?= $idVentaTmp ?>">
    </form>
    </main>
    <?= $this->endSection(); ?>