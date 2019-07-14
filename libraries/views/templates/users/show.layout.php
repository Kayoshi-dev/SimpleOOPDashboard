<?php

?>

<h1>Liste des utilisateurs</h1>

</div>

<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">id</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Pass</th>
            <th scope="col">Email</th>
            <th scope="col">Date_Inscription</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <?php
    foreach ($data as $user) : ?>
        <tbody>
            <tr>
                <th scope="col" id="idUser"><?= $user->id ?></th>
                <td><?= $user->pseudo ?></td>
                <td><?= $user->pass ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->date_inscription ?></td>
                <td>
                    <button data-iduser="<?= $user->id ?>" href="index.php?controller=user&task=delete&id=<?= $user->id ?>" id="deleteButton" data-toggle="modal" data-target="#deleteModal" class="px-0 py-0 mr-2 btn btn-sq-xs">
                        <i class="fa fa-times" style="color: red;"></i>
                    </button>
                    <button class="px-0 py-0 btn btn-sq-xs">
                        <i class="fa fa-pencil" style="color: darkorange"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    <?php endforeach; ?>
</table>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Suppression d'un utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php //var_dump($userModel->findById($_GET['id'])) ?>
                <p>Souhaitez vous supprimer l'utilisateur ?</p>
            </div>
            <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                <div id="deleteSection">

                </div>
            </div>
        </div>
    </div>
</div>