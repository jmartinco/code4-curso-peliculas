<?= $this->extend('Layouts/blog')  ?>
<?= $this->section('contenido')  ?>
<h1>Peliculas</h1>
<hr>
<div class="card my-2 text-bg-info">
    <div class="card-body">
        <form action="" method="get">
            <div class="d-flex gap-2">
                <select class="form-control flex-grow-1 categoria_id" name="categoria_id" id="">
                    <option value="">Categoria</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option <?= $categoria->id == $categoria_id ? 'selected' : '' ?> value="<?= $categoria->id ?>"><?= $categoria->titulo ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-control mb-1 etiqueta_id" name="etiqueta_id" id="">
                    <option value="">Etiqueta</option>
                    <?php foreach ($etiquetas as $etiqueta): ?>
                        <option <?= $etiqueta->id == $etiqueta_id ? 'selected' : '' ?> value="<?= $etiqueta->id ?>"><?= $etiqueta->titulo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex gap-2 mt-2">
                <input placeholder="Buscar" class="form-control mb-1" type="text" name="buscar" value="<?= $buscar ?>" id="">
                <button class="btn btn-primary mb-3" type="submit">Enviar</button>
                <a style="width: 195px;" class="btn btn-secondary" href="<?= route_to('blog.pelicula.index') ?>">Limpiar Filtro</a>
            </div>
        </form>
    </div>
</div>
<?= view('partials/_peliculas') ?>

<script>
    document.querySelector('.categoria_id').addEventListener('change', () => {
        fetch('/blog/etiquetas_por_categoria/' + document.querySelector('.categoria_id').value)
            .then(res => res.json())
            .then(res => {
                console.log(res);

                var etiquetas = '<option value="">Etiqueta</option>';

                res.forEach((e) => {
                    etiquetas += `
                <option value="${e.id}">${e.titulo}</option>
                `
                })

                document.querySelector('.etiqueta_id').innerHTML = etiquetas

            })

    })
</script>

<?php $this->endSection('contenido') ?>