<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="card" style="width: 50rem;">
        <div class="card-body">
            <h1>
                Listado de Categorias
            </h1>
            <a class="text-primary" href="/categoria/new">Crear</a>
            <table class="table table table-striped">
                <tr>
                    <th scope="col">ID</th>
                    <th>Titulo</th>

                    <th>Opciones</th>
                </tr>
                <?php foreach ($categorias as $key => $p) : ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['titulo'] ?></td>
                        <td>
                            <a href="/categoria/show/<?= $p['id'] ?>">Show</a>
                            <a href="/categoria/edit/<?= $p['id'] ?>">Editar</a>
                            <form action="/categoria/delete/<?= $p['id'] ?>" method="post" style="display:inline;">
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta Categoria?');" class="btn btn-link p-0 m-0 align-baseline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>