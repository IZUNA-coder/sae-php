<?php
namespace controller;

class ControllerLogin extends Controller
{
    public function view(): void
    {
        if (isset($_SESSION['username'])) {
            $this->redirect('ControllerHome', 'view');
        } else {
            $this->render('login.php');
        }
    }

    public function login(): void
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($username === 'admin' && $password === 'admin') {
                $_SESSION['username'] = $username;
                $this->redirect('ControllerHome', 'view');
            } else {
                $this->render('login.php', [
                    'error' => 'Identifiant ou mot de passe incorrect',
                ]);
            }
        } else {
            $this->render('login.php');
        }
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('ControllerLogin', 'view');
    }
}