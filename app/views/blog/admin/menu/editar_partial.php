<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Editar</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="/admin/menu/editar/<?=$id?>">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td><a href="/admin/menu">Cerrar</a></td>
                </tr>
                <tr>
                    <td><input type="text" name="name" placeholder="Nombre" required value="<?=$infonav[0]->name?>" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="url" placeholder="url" required value="<?=$infonav[0]->url?>" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="heading" placeholder="Titulo principal" value="<?=$infonav[0]->heading?>" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="secondarytext" placeholder="Titulo secundario" value="<?=$infonav[0]->secondarytext?>" /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="boton_editar" value="editar">Editar</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>
