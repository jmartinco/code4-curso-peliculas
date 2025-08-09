<?= $this->extend('Layouts/web') ?>

<?= $this->section('contenido') ?>

<?= view('partials/_form-error') ?>


<form action="<?= route_to('usuario.register_post') ?>" method="post" class="p-4 border rounded shadow-sm bg-light" style="max-width: 400px; margin: auto;">
    <h4 class="mb-4 text-center">Iniciar Sesión</h4>

    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingresa tu usuario">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Ingresa tu email o usuario">
    </div>

    <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Ingresa tu contraseña">
    </div>

    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
</form>
<?= $this->endSection() ?>