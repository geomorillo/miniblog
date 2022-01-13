<!------ Installer view ---------->
<?= $installer ?>
http://techlaboratory.net/jquery-smartwizard
<link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>

<div id="smartwizard">
    <ul class="nav">
        <li>
            <a class="nav-link" href="#step-1">
                Licencia
            </a>
        </li>
        <li>
            <a class="nav-link" href="#step-2">
                Requerimientos
            </a>
        </li>
        <li>
            <a class="nav-link" href="#step-3">
                Configuración
            </a>
        </li>
        <li>
            <a class="nav-link" href="#step-4">
                Instalación
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="step-1" class="tab-pane" role="tabpanel">
            <?= $licencia ?>
        </div>
        <div id="step-2" class="tab-pane" role="tabpanel">
            <div>
                <ul>
                    <?= $requerimientos ?>
                </ul>
            </div>
            <p>Errores</p>
            <div>
                <ul>
                    <?= isset($errores) ? $errores : "Ningún error" ?>
                </ul>
            </div>
        </div>
        <div id="step-3" class="tab-pane" role="tabpanel">
        <?=$dbPartial?>

        </div>
        <div id="step-4" class="tab-pane" role="tabpanel">
            Step content
        </div>
    </div>
</div>