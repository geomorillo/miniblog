<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Editar</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="/admin/categorias/editar/<?=$id?>">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td><a href="/admin/menu">Cerrar</a></td>
                </tr>
                <tr>
                    <td><input type="text" name="name" placeholder="Nombre" required value="<?=$info[0]->name?>" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="url" placeholder="url" required value="<?=$info[0]->url?>" /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="boton_editar" value="editar">Editar</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>
