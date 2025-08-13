<?= $this->extend('dashboard/Layouts/dashboard') ?>

<?= $this->section('header') ?>
<h2>Dashboard - Etiquetas</h2>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>


<h1>
    Listado de Etiquetas
</h1>

<a class="btn btn-outline-primary btn-lg mb-4" href="/dashboard/etiqueta/new">Crear</a>
<table class="table table table-striped">
    <tr>
        <th scope="col">ID</th>
        <th>Titulo</th>
        <th>Categoría</th>
        <th>Opciones</th>
    </tr>
    <?php foreach ($etiquetas as $key => $e) : ?>
        <tr>
            <td><?= $e->id ?></td>
            <td><?= $e->titulo ?></td>
            <td><?= $e->categoria ?></td>
            <td>
                <a href="/dashboard/etiqueta/show/<?= $e->id ?>" class="btn btn-outline-info btn-sm mt-1">Show</a>
                <a href="/dashboard/etiqueta/edit/<?= $e->id ?>" class=" btn btn-outline-success btn-sm mt-1">Editar</a>
                <form action="/dashboard/etiqueta/delete/<?= $e->id ?>" method="post" style="display:inline;">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta etiqueta?');" class="btn btn-outline-danger btn-sm mt-1">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?= $pager->links('default') ?>
<?= $this->endSection() ?>