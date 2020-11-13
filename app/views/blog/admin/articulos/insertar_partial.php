<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Crear Articulo</h3>
    </div>
    <div class="panel-body">


        <form method="post" href="/admin/articulos/insertar/ok">
            <div class="form-group">
                <button class="btn btn-primary"  type="submit" name="boton_insertar" value="insertar"><i class="fa fa-floppy-o"></i> SALVAR</button>
            </div>
            <div class="form-group">
                <label>Titulo:</label><input type="text" name="title" required/>
                <label>Categoria:</label><?= $categorias_select ?>
                <label>Imagen:</label><?= $imagen_select ?>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="readmore"/> Read More:
                </label>
            </div>
            
            <textarea class="editor" id="articulo" name="articulo"></textarea>
        </form>
        <span><a href="/admin/articulos" class="btn btn-primary">Cancelar</a></span>
    </div>
</div>
