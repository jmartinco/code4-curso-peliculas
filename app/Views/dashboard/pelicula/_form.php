 <label class="form-label" for="titulo">Título</label>
 <input type="text" name="titulo" placeholder="Título" value="<?= old('titulo', $pelicula->titulo) ?>" id="titulo" class="form-control mt-1 mb-1">
 <label class="form-label" for="categoria_id">Categoría</label>
 <select name="categoria_id" id="categoria_id" class="form-control mt-1 mb-1">
     <option value="">-- Seleccione --</option>
     <?php foreach ($categorias as $categoria): ?>
         <option value="<?= $categoria->id ?>" <?= old('categoria_id', $pelicula->categoria_id) == $categoria->id ? 'selected' : '' ?>>
             <?= $categoria->titulo ?>
         </option>
     <?php endforeach; ?>
 </select>
 <label class="form-label" for="description">Descripción</label>
 <textarea name="description" placeholder="Descripción" id="description" class="form-control mt-1 mb-1"><?= old('description', $pelicula->description) ?></textarea>
 <?php if ($pelicula->id):  ?>
     <label class="form-label" for="imagen">Imagen</label>
     <input type="file" name="imagen" id="imagen" class="form-control mt-1 mb-1">
 <?php endif ?>
 <button type="submit" class="btn btn-outline-primary mb-1 mt-1">Enviar</button>