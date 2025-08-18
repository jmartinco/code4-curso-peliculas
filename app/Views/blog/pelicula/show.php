<?= $this->extend('Layouts/blog') ?>
<?= $this->section('contenido') ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="text-primary"><?= $pelicula->titulo ?></h1>
            <hr>
            <a href="<?= route_to('blog.pelicula.index_por_categoria', $pelicula->categoria_id) ?>" class="btn btn-outline-success mb-2"><?= $pelicula->categoria ?> </a>
            <p><?= $pelicula->description ?></p>

            <h3>Imágenes</h3>

            <div class="d-flex gap-2">
                <?php foreach ($imagenes as $i) : ?>
                    <img src="<?= base_url('uploads/peliculas/' . $i->imagen) ?>" alt="<?= $i->imagen ?>" class="img-thumbnail w-25">
                    <br>
                <?php endforeach; ?>
            </div>


            <h3>Etiquetas</h3>
            <?php foreach ($etiquetas as $e) : ?>
                <a class="btn btn-sm btn-outline-warning" href="<?= route_to('blog.pelicula.index_por_etiqueta', $e->id) ?>"><?= $e->titulo ?> </a>
            <?php endforeach; ?>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>