 <label for="titulo">Título</label>
 <input type="text" name="titulo" placeholder="Título" value="<?= old('titulo', $categoria->titulo) ?>" id="titulo" class="form-control">
 <button type="submit" class="btn btn-outline-primary"><?= $op ?></button>