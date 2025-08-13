<?= $this->extend('dashboard/Layouts/dashboard') ?>

<?= $this->section('header') ?>
<h2>Dashboard - Peliculas</h2>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>


<h1>
    Listado de peliculas
</h1>

<a class="btn btn-outline-primary btn-lg mb-4" href="/dashboard/pelicula/new">Crear</a>
<table class="table table table-striped">
    <tr>
        <th scope="col">ID</th>
        <th>Titulo</th>
        <th>Categoría</th>
        <th>Descripción</th>
        <th>Opciones</th>
    </tr>
    <?php foreach ($peliculas as $key => $p) : ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= $p->titulo ?></td>
            <td><?= $p->categoria ?></td>
            <td><?= $p->description ?></td>
            <td>
                <a href="/dashboard/pelicula/show/<?= $p->id ?>" class="btn btn-outline-info btn-sm mt-1">Show</a>
                <a href="/dashboard/pelicula/edit/<?= $p->id ?>" class="btn btn-outline-success  btn-sm mt-1">Editar</a>
                <a href="<?= route_to('pelicula.etiquetas', $p->id) ?>" class="btn btn-outline-secondary  btn-sm mt-1">Etiquetas</a>
                <form action="/dashboard/pelicula/delete/<?= $p->id ?>" method="post" style="display:inline;">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta película?');" class="btn btn-outline-danger btn-sm mt-1">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?= $pager->links('default') ?>

<?= $this->endSection() ?>