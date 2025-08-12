<?= $this->extend('dashboard/Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
<div class="container">
    <h1 class="text-primary"><?= $pelicula->titulo ?></h1>
    <p><?= $pelicula->description ?></p>
</div>
<h3>Imágenes</h3>
<ul class="list-group">
    <?php foreach ($imagenes as $i) : ?>
        <li class="list-group-item"><?= $i->imagen ?></li>
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