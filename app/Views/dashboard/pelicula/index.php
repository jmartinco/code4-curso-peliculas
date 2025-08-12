<?= $this->extend('dashboard/Layouts/dashboard') ?>

<?= $this->section('header') ?>
<h2>Dashboard - Peliculas</h2>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>


<h1>
    Listado de peliculas
</h1>

<a class="text-primary" href="/dashboard/pelicula/new">Crear</a>
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
                <a href="/dashboard/pelicula/show/<?= $p->id ?>">Show</a>
                <a href="/dashboard/pelicula/edit/<?= $p->id ?>">Editar</a>
                <a href="<?= route_to('pelicula.etiquetas', $p->id) ?>">Etiquetas</a>
                <form action="/dashboard/pelicula/delete/<?= $p->id ?>" method="post" style="display:inline;">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta película?');" class="btn btn-link p-0 m-0 align-baseline">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection() ?>