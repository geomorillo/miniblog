<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Insertar</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="/admin/menu/insertar">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td><a href="/admin/menu">Cerrar</a></td>
                </tr>
                <tr>
                    <td><input type="text" name="name" placeholder="Nombre" required /></td>
                </tr>
                <tr>
                    <td><input type="text" name="url" placeholder="url" required /></td>
                </tr>
                <tr>
                    <td><input type="text" name="heading" placeholder="Titulo principal" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="secondarytext" placeholder="Titulo secundario" /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="boton_insertar" value="insertar">Insertar</button></td>
                </tr>
            </table>
        </form>  
    </div>
</div>
