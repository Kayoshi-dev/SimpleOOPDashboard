<?php

namespace Controllers;

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
}