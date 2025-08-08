 <label for="titulo">Título</label>
 <input type="text" name="titulo" placeholder="Título" value="<?= $pelicula['titulo'] ?>" required id="titulo" class="form-control">
 <label for="description">Descripción</label>
 <textarea name="description" placeholder="Descripción" required id="description" class="form-control"><?= $pelicula['description'] ?></textarea>
 <button type="submit" class="btn btn-outline-primary">Enviar</button>