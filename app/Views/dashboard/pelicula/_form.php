 <label for="titulo">Título</label>
 <input type="text" name="titulo" placeholder="Título" value="<?= old('titulo', $pelicula->titulo) ?>" id="titulo" class="form-control">
 <label for="categoria_id">Categoría</label>
 <select name="categoria_id" id="categoria_id" class="form-control">
     <option value="">-- Seleccione --</option>
     <?php foreach ($categorias as $categoria): ?>
         <option value="<?= $categoria->id ?>" <?= old('categoria_id', $pelicula->categoria_id) == $categoria->id ? 'selected' : '' ?>>
             <?= $categoria->titulo ?>
         </option>
     <?php endforeach; ?>
 </select>
 <label for="description">Descripción</label>
 <textarea name="description" placeholder="Descripción" id="description" class="form-control"><?= old('description', $pelicula->description) ?></textarea>
 <?php if ($pelicula->id):  ?>
     <label for="imagen">Imagen</label>
     <input type="file" name="imagen" id="imagen" class="form-control">
 <?php endif ?>
 <button type="submit" class="btn btn-outline-primary">Enviar</button>