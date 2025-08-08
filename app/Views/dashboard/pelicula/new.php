<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Pelicula</title>
</head>

<body>
    <form action="/dashboard/pelicula/create" method="post">
        <?= view('dashboard/pelicula/_form', ['op' => 'Crear']) ?>
    </form>
</body>

</html>