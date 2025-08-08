<?= $this->extend('dashboard/Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
<form action="/dashboard/categoria/update/<?= $categoria['id'] ?>" method="post">
    <?= view('dashboard/categoria/_form', ['op' => 'Actualizar']) ?>
</form>
<?= $this->endSection() ?>