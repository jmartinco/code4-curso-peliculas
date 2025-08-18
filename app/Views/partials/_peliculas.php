<?php foreach ($peliculas as $p): ?>
    <div class="card mb-3">
        <div class="card-body">

            <img src="<?= base_url('uploads/peliculas/' . $p->imagen) ?>" alt="<?= $p->imagen ?>" class="img-thumbnail w-25">

            <h4>
                <?= $p->titulo ?>
                <a href="<?= route_to('blog.pelicula.index_por_categoria', $p->categoria_id) ?>" class="btn btn-outline-secondary btn-sm"><?= $p->categoria ?> </a>
            </h4>
            <p>
                <?= $p->description ?>
            </p>
            <span>
                <?= $p->etiquetas ?>
            </span>
            <a class="btn btn-outline-success" href="<?= route_to('blog.pelicula.show', $p->id) ?>">Ver...</a>
        </div>
    </div>
<?php endforeach; ?>
<?= $pager->links() ?>