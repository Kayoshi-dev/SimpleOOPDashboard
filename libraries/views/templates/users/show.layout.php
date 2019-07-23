<div class="row">
    <div class="col-md-4">
        <h1>Liste des utilisateurs</h1>
    </div>
    <div class="offset-md-2 col-md-4">
        <div class="form-group row align-items-center">
            <h5 class="col-md-6">Chercher un membre :</h5>
            <div class="col-md-6">
                <input type="text" class="form-control" id="searchMember" placeholder="Write his name">
            </div>
        </div>
    </div>
</div>

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
    <tbody id="memberTable">
    <?php
    foreach ($data as $user) : ?>
        <tr>
            <th scope="col" id="idUser"><?= $user->id ?></th>
            <td>
                <?= $user->pseudo ?>
                <img src="public/upload/profilepic/<?php if($user->profilepic != null){ echo $user->profilepic; } else { echo 'default.jpg'; } ?>" alt="defaultProfilePic" height="25" width="25" class="rounded-circle" id="previewImg">
            </td>
            <td><?= $user->pass ?></td>
            <td><?= $user->email ?></td>
            <td><?= $user->date_inscription ?></td>
            <td>
                <button data-iduser="<?= $user->id ?>" id="deleteButton" data-toggle="modal" data-target="#deleteModal" class="px-0 py-0 mr-2 btn btn-sq-xs">
                    <i class="fa fa-times" style="color: red;"></i>
                </button>
                <a href="index.php?task=edit&id=<?= $user->id ?>" class="px-0 py-0 btn btn-sq-xs">
                    <i class="fa fa-pencil" style="color: darkorange"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
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