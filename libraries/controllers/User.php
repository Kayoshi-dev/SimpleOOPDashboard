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

        if (is_uploaded_file($_FILES['profilePic']['tmp_name'])) {
            if ($_FILES['profilePic']['tmp_name'] != 'default.jpg') {
                $extensions = array('jpg', 'jpeg', 'gif', 'png');

                $file_ext = explode('.', $_FILES['profilePic']['name']);
                $file_ext = end($file_ext);

                if (in_array(strtolower($file_ext), $extensions)) {
                    if ($_FILES['profilePic']['error'] == 0) {
                        $picName = $id . '.' . $file_ext;
                        move_uploaded_file($_FILES['profilePic']['tmp_name'], 'public/upload/profilepic/' . strtolower($picName));
                        $etat = $this->model->update($_POST['pseudo'], $password, $_POST['email'], $id, $picName);
                    } else {
                        $etat = false;
                    }
                } else {
                    $etat = false;
                }
            }
        } else if (is_uploaded_file($_FILES['bannerPic']['tmp_name'])) {
            if ($_FILES['bannerPic']['tmp_name'] != 'default.jpg') {
                $extensions = array('jpg', 'jpeg', 'gif', 'png');

                $file_ext = explode('.', $_FILES['bannerPic']['name']);
                $file_ext = end($file_ext);

                if (in_array(strtolower($file_ext), $extensions)) {
                    if ($_FILES['bannerPic']['error'] == 0) {
                        $bannerPic = $id . '.' . $file_ext;
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
            //TODO User can't upload a Profile Picture and a Banner in the same time
        } else {
            $etat = $this->model->update($_POST['pseudo'], $password, $_POST['email'], $id);
        }

        \Http::redirect('index.php?controller=user&task=show', $etat);
    }
}