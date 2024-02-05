<?php
namespace controller;

class ControllerRegister extends Controller
{
    public function view(): void
    {
        if (isset($_SESSION['username'])) {
            $this->redirect('ControllerHome', 'view');
        } else {
            $this->render('register.php');
        }
    }

    public function register(): void
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($username === 'admin' && $password === 'admin') {
                $_SESSION['username'] = $username;
                $this->redirect('ControllerHome', 'view');
            } else {
                $this->render('register.php', [
                    'error' => 'Identifiant ou mot de passe incorrect',
                ]);
            }
        } else {
            $this->render('register.php');
        }
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('ControllerRegister', 'view');
    }
}