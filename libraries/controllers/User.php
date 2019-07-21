<?php

namespace Controllers;

use utils\utils;

class User extends Controller {

    protected $modelName = \Models\User::class;

    public function index(){
        $pageTitle = 'Accueil';

        \Renderer::Render('users/index', compact('pageTitle'));
    }

    public function show() {
        $data = $this->model->show();

        $pageTitle = "Liste des utilisateurs";

        \Renderer::Render('users/show', compact('pageTitle', 'data'));
    }

    public function insert() {
        $pageTitle = 'Ajout d\'un membre';

        \Renderer::Render('users/add', compact('pageTitle'));
    }

    public function add() {
        $pseudo = $_POST['pseudo'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT );
        $email = $_POST['email'];

        $etat = $this->model->add($pseudo, $password, $email);

        utils::sendMail($email, 'Inscription au site de Maxime', 'Bienvenue sur le site internet');

        \Http::redirect('index.php?controller=user&task=insert', $etat);
    }

    public function delete() {
        if(empty($_GET['id'])) {
            die('Merci de préciser un ID valide :)');
        }

        $id = (int)$_GET['id'];

        $etat = $this->model->delete($id);

        \Http::redirect('index.php?controller=user&task=show', $etat);
    }

    public function edit() {
        if(empty($_GET['id'])) {
            \Http::redirect('index.php?controller=user&task=show');
        }
        $pageTitle = 'Edition de membres';

        $id = (int)$_GET['id'];

        $data = $this->model->findById($id);

       \Renderer::Render('users/edituser', compact('pageTitle', 'data'));
    }

    public function update()
    {
        $id = (int)$_GET['id'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        if (is_uploaded_file($_FILES['profilePic']['tmp_name']) && empty($_FILES['bannerPic'])) {
            if ($_FILES['profilePic']['tmp_name'] != 'default.jpg') {
                $extensions = array('jpg', 'jpeg', 'gif', 'png');

                $profilePicExt = explode('.', $_FILES['profilePic']['name']);
                $profilePicExt = end($profilePicExt);

                if (in_array(strtolower($profilePicExt), $extensions)) {
                    if ($_FILES['profilePic']['error'] == 0) {
                        $profilePicName = $id . '.' . $profilePicExt;
                        move_uploaded_file($_FILES['profilePic']['tmp_name'], 'public/upload/profilepic/' . strtolower($profilePicName));
                        $etat = $this->model->update($_POST['pseudo'], $password, $_POST['email'], $id, $profilePicName);
                    } else {
                        $etat = false;
                    }
                } else {
                    $etat = false;
                }
            }
        } else if (is_uploaded_file($_FILES['bannerPic']['tmp_name']) && empty($_FILES['profilePic'])) {
            if ($_FILES['bannerPic']['tmp_name'] != 'default.jpg') {
                $extensions = array('jpg', 'jpeg', 'gif', 'png');

                $profilePicExt = explode('.', $_FILES['bannerPic']['name']);
                $profilePicExt = end($profilePicExt);

                if (in_array(strtolower($profilePicExt), $extensions)) {
                    if ($_FILES['bannerPic']['error'] == 0) {
                        $bannerPic = $id . '.' . $profilePicExt;
                        move_uploaded_file($_FILES['bannerPic']['tmp_name'], 'public/upload/bannerpic/' . strtolower($bannerPic));
                        $etat = $this->model->update($_POST['pseudo'], $password, $_POST['email'], $id, '', $bannerPic);
                    } else {
                        $etat = false;
                    }
                } else {
                    $etat = false;
                }
            }
        } else if (is_uploaded_file($_FILES['profilePic']['tmp_name']) && is_uploaded_file($_FILES['bannerPic']['tmp_name'])) {
            //Really bad code, should improve it.
            if ($_FILES['profilePic']['tmp_name'] != 'default.jpg' && $_FILES['bannerPic']['tmp_name'] != 'default.jpg') {
                $extensions = array('jpg', 'jpeg', 'gif', 'png');

                $profilePicExt = explode('.', $_FILES['profilePic']['name']);
                $profilePicExt = end($profilePicExt);

                $bannerPicExt = explode('.', $_FILES['bannerPic']['name']);
                $bannerPicExt = end($bannerPicExt);

                if (in_array(strtolower($profilePicExt), $extensions) && in_array(strtolower($bannerPicExt), $extensions)) {
                    if ($_FILES['profilePic']['error'] == 0 && $_FILES['bannerPic']['error'] == 0) {
                        $profilePicName = $id . '.' . $profilePicExt;
                        $bannerPicName = $id . '.' . $bannerPicExt;
                        move_uploaded_file($_FILES['profilePic']['tmp_name'], 'public/upload/profilepic/' . strtolower($profilePicName));
                        move_uploaded_file($_FILES['bannerPic']['tmp_name'], 'public/upload/bannerpic/' . strtolower($bannerPicName));
                        $etat = $this->model->update($_POST['pseudo'], $password, $_POST['email'], $id, $profilePicName, $bannerPicName);
                    } else {
                        $etat = false;
                    }
                } else {
                    $etat = false;
                }
            }
        } else {
            $etat = $this->model->update($_POST['pseudo'], $password, $_POST['email'], $id);
        }

        \Http::redirect('index.php?controller=user&task=show', $etat);
    }
}