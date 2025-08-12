 <label for="titulo">Título</label>
 <input type="text" name="titulo" placeholder="Título" value="<?= old('titulo', $etiqueta->titulo) ?>" id="titulo" class="form-control">
 <label for="categoria_id">Categoría</label>
 <select name="categoria_id" id="categoria_id" class="form-control">
     <option value="">-- Seleccione --</option>
     <?php foreach ($categorias as $categoria): ?>
         <option value="<?= $categoria->id ?>" <?= old('categoria_id', $etiqueta->categoria_id) == $categoria->id ? 'selected' : '' ?>>
             <?= $categoria->titulo ?>
         </option>
     <?php endforeach; ?>
 </select>
 <button type="submit" class="btn btn-outline-primary">Enviar</button>