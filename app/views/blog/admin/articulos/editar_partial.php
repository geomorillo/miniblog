<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Editar Articulo</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="/admin/articulos/editar/<?= $info[0]->id ?>">
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="boton_editar" value="editar"><i class="fa fa-floppy-o"></i> SALVAR</button>
            </div>
            <div class="form-group">
                <label>Titulo:</label><input type="text" name="title" value="<?= $info[0]->title ?>"/>
                <label>Categoria:</label><?= $categorias_select ?>
                <label>Imagen:</label><?= $imagen_select ?>

            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="readmore" checked="<?= $info[0]->readmore ?>" value=""/> Read More:
                </label>
            </div>
            <textarea class="editor" id="articulo" name="articulo"><?= $info[0]->text ?></textarea>
        </form>
    </div>
</div>
