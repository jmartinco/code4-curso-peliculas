<?= $this->extend('dashboard/Layouts/dashboard') ?>

<?= $this->section('header') ?>
<h2>Dashboard - Etiquetas</h2>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>


<h1>
    Listado de Etiquetas
</h1>

<a class="text-primary" href="/dashboard/etiqueta/new">Crear</a>
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
                <a href="/dashboard/etiqueta/show/<?= $e->id ?>">Show</a>
                <a href="/dashboard/etiqueta/edit/<?= $e->id ?>">Editar</a>
                <form action="/dashboard/etiqueta/delete/<?= $e->id ?>" method="post" style="display:inline;">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta etiqueta?');" class="btn btn-link p-0 m-0 align-baseline">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?= $pager->links('default') ?>
<?= $this->endSection() ?>