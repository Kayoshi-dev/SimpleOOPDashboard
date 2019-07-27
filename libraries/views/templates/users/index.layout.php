<?php
    $widget = new \Controllers\Widget();
    $data = $widget->showActiveWidget();
    $command = $widget->doCommand();
?>

<div class="row">
    <h1>Accueil</h1>
    <a href="?controllers=widget&task=widgetSection" class="btn btn-outline-primary">Choisir des widgets</a>
</div>

</div>



<div class="container-fluid">
    <div class="row mb-3">
        <?php
        foreach ($data as $activeWidget):?>

            <div class="col-md-3">
                <div class="card border-primary">
                    <div class="card-header"><h5> <?= $activeWidget->widget_name ?></h5></div>
                    <div class="card-body">

                        <p class="card-text"> <?= '<h1>bjr</h1>' ?></p>
                    </div>
                </div>
            </div>

        <?php endforeach;?>
    </div>
</div>
