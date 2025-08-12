<?= $this->extend('dashboard/Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
<div class="container">
    <h1 class="text-primary"><?= $pelicula->titulo ?></h1>
    <p><?= $pelicula->description ?></p>
</div>
<h3>Imágenes</h3>
<ul class="list-group">
    <?php foreach ($imagenes as $i) : ?>
        <li class="list-group-item">
            <img src="<?= base_url('uploads/peliculas/' . $i->imagen) ?>" alt="<?= $i->imagen ?>" class="img-thumbnail" style="width: 200px; height: 200px;">
            <form action="<?= route_to('pelicula.borrar_imagen', $i->id) ?>" method="post" class="d-inline">
                <button type="submit" class="btn btn-outline-danger delete_imagen">Eliminar</button>
            </form>
            <form action="<?= route_to('pelicula.descargar_imagen', $i->id) ?>" method="post" class="d-inline">
                <button type="submit" class="btn btn-outline-primary delete_imagen">Descargar</button>
            </form>
            <br>
        </li>
    <?php endforeach; ?>
</ul>

<h3>Etiquetas</h3>
<?php foreach ($etiquetas as $e) : ?>

    <button data-url="<?= route_to('pelicula.etiqueta_delete', $pelicula->id, $e->id) ?>" type="button" class="btn btn-outline-primary delete_etiqueta"><?= $e->titulo ?></button>

<?php endforeach; ?>

<script>
    document.querySelectorAll('.delete_etiqueta').forEach((b) => {
        //console.log(b.getAttribute('data-url'))
        b.onclick = function(event) {
            //console.log(this.getAttribute('data-url'))
            fetch(this.getAttribute('data-url'), {
                    method: 'POST'
                }).then(res => res.json())
                .then(res => {
                    window.location.reload()
                    //console.log(res)
                })

        }

    })
</script>

<?= $this->endSection() ?>