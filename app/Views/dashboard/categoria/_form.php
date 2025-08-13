 <label class="form-label" for="titulo">Título</label>
 <input type="text" name="titulo" placeholder="Título" value="<?= old('titulo', $categoria->titulo) ?>" id="titulo" class="form-control mt-1 mb-1">
 <button type="submit" class="btn btn-outline-primary mt-1 mb-1"><?= $op ?></button>