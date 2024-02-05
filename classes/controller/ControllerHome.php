<?php

namespace controller;

class ControllerHome extends Controller
{
    public function view(): void
    {
        if (isset($_SESSION['username'])) {
            $this->render('home.php', [
                'username' => $_SESSION['username'],
                ]);
        }else{
            $this->redirect('ControllerLogin.php', 'view');
        }
    }

    public function submit(): void
    {
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'connexion') {
                $this->redirect('ControllerLogin', 'view');
            } else {
                $this->redirect('ControllerRegister', 'view');
            }
        }
    }
}