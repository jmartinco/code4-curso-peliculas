 <label for="titulo">Título</label>
 <input type="text" name="titulo" placeholder="Título" value="<?= old('titulo', $pelicula->titulo) ?>" id="titulo" class="form-control">
 <label for="description">Descripción</label>
 <textarea name="description" placeholder="Descripción" id="description" class="form-control"><?= old('description', $pelicula->description) ?></textarea>
 <button type="submit" class="btn btn-outline-primary">Enviar</button>