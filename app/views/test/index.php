<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Facturas</h4>
                <span class="category">Todas las facturas elaboradas</span>
            </div>
            <div class="content">
                <form action="/facturas/insert" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cliente</label>
                                <select class="form-control select2" name="cliente">
                                    <option></option>
                                    <?php foreach($clientes as $cliente): ?>
                                    <option value="<?= $cliente->id?>"><?= $cliente->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Otro Cliente</label>
                                <input type="text" id="otro_cliente" class="form-control" name="otro_cliente">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>