<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>MENU PRINCIPAL</h2>   
            </div>
        </div>              
        <!-- /. ROW  -->
        <hr />

        <?= $navbar_partial ?>

        <hr />
        
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Url</th>
                    <th>Titulo</th>
                    <th>Titulo Secundario</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?=$tablemenu?>
                
            </tbody>
        </table>
        <hr />
        
        <?=$contenido?>
        <!-- /. ROW  -->           
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>

<!-- /. WRAPPER  -->