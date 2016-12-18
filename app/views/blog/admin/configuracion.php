<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>CONFIGURACION</h2>   
            </div>
        </div>              
        <!-- /. ROW  -->
        <hr />
        <form method="POST" action="/admin/config/salvar">
            <label for="titulo">Titulo del blog</label>
            <input type="text" name="titulo" value="<?= $title ?>"/>
            <button type="submit" name="boton_salvar" value="salvar">Salvar</button>
        </form>
         <hr />
         <?=$contenido?>
        <!-- /. ROW  -->           
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>

<!-- /. WRAPPER  -->