<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?= $pelicula['titulo'] ?></title>
</head>

<body>
    <div class="container">
        <h1 class="text-primary"><?= $pelicula['titulo'] ?></h1>
        <p><?= $pelicula['description'] ?></p>
    </div>
</body>

</html>