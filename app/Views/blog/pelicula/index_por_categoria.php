<?= $this->extend('Layouts/blog')  ?>
<?= $this->section('contenido')  ?>
<h1>Peliculas por categoria: <?= $categoria->titulo ?> </h1>
<hr>
<?= view('partials/_peliculas') ?>


<?php $this->endSection('contenido') ?>