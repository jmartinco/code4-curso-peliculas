<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modulo web</title>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <div class="card shadow-lg" style="max-width: 900px;">
                <div class="card-body text-justify">
                    <h1><?= $this->renderSection('header') ?> </h1>
                    <?= view('partials/_session') ?>
                    <?= $this->renderSection('contenido') ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>