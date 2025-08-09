<?= $this->extend('dashboard/Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
<div class="container">
    <h1 class="text-primary"><?= $pelicula->titulo ?></h1>
    <p><?= $pelicula->description ?></p>
</div>
<?= $this->endSection() ?>