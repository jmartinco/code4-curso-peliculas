<?= $this->extend('dashboard/Layouts/dashboard') ?>

<?= $this->section('header') ?>
<h2>Dashboard - Categorias</h2>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>


<h1>
    Listado de Categorias
</h1>
<a class="text-primary" href="/dashboard/categoria/new">Crear</a>
<table class="table table table-striped">
    <tr>
        <th scope="col">ID</th>
        <th>Titulo</th>

        <th>Opciones</th>
    </tr>
    <?php foreach ($categorias as $key => $p) : ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= $p->titulo ?></td>
            <td>
                <a href="/dashboard/categoria/show/<?= $p->id ?>">Show</a>
                <a href="/dashboard/categoria/edit/<?= $p->id ?>">Editar</a>
                <form action="/dashboard/categoria/delete/<?= $p->id ?>" method="post" style="display:inline;">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta Categoria?');" class="btn btn-link p-0 m-0 align-baseline">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<?= $this->endSection() ?>