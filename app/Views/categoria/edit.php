<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizar Categoria</title>
</head>

<body>
    <form action="/categoria/update/<?= $categoria['id'] ?>" method="post">
        <?= view('categoria/_form', ['op' => 'Actualizar']) ?>
    </form>
</body>

</html>