<?= $this->extend('dashboard/Layouts/dashboard') ?>

<?= $this->section('header') ?>
<h2>Dashboard - Etiquetas</h2>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<?= view('partials/_form-error') ?>
<form action="/dashboard/etiqueta/create" method="post">
    <?= view('dashboard/etiqueta/_form', ['op' => 'Crear']) ?>
</form>
<?= $this->endSection() ?>