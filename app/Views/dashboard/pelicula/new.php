<?= $this->extend('dashboard/Layouts/dashboard') ?>

<?= $this->section('header') ?>
<h2>Dashboard - Categorias</h2>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<?= view('partials/_form-error') ?>
<form action="/dashboard/pelicula/create" method="post">
    <?= view('dashboard/pelicula/_form', ['op' => 'Crear']) ?>
</form>
<?= $this->endSection() ?>