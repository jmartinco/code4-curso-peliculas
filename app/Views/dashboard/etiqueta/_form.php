 <label class="form-label" for="titulo">Título</label>
 <input type="text" name="titulo" placeholder="Título" value="<?= old('titulo', $etiqueta->titulo) ?>" id="titulo" class="form-control mt-1 mb-1">
 <label class="form-label" for="categoria_id">Categoría</label>
 <select name="categoria_id" id="categoria_id" class="form-control mt-1 mb-1">
     <option value="">-- Seleccione --</option>
     <?php foreach ($categorias as $categoria): ?>
         <option value="<?= $categoria->id ?>" <?= old('categoria_id', $etiqueta->categoria_id) == $categoria->id ? 'selected' : '' ?>>
             <?= $categoria->titulo ?>
         </option>
     <?php endforeach; ?>
 </select>
 <button type="submit" class="btn btn-outline-primary mt-1 mb-1">Enviar</button>