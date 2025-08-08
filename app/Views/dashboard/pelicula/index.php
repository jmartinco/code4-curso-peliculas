<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Peliculas</title>
</head>

<body class="h-screen flex items-center justify-center bg-gray-100">
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <div class="card shadow-lg" style="max-width: 1200px;">
                <div class="card-body text-center">
                    <h1>
                        Listado de peliculas
                    </h1>
                    <a class="text-primary" href="/dashboard/pelicula/new">Crear</a>
                    <table class="table table table-striped">
                        <tr>
                            <th scope="col">ID</th>
                            <th>Titulo</th>
                            <th>Descripción</th>
                            <th>Opciones</th>
                        </tr>
                        <?php foreach ($peliculas as $key => $p) : ?>
                            <tr>
                                <td><?= $p['id'] ?></td>
                                <td><?= $p['titulo'] ?></td>
                                <td><?= $p['description'] ?></td>
                                <td>
                                    <a href="/dashboard/pelicula/show/<?= $p['id'] ?>">Show</a>
                                    <a href="/dashboard/pelicula/edit/<?= $p['id'] ?>">Editar</a>
                                    <form action="/dashboard/pelicula/delete/<?= $p['id'] ?>" method="post" style="display:inline;">
                                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta película?');" class="btn btn-link p-0 m-0 align-baseline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>