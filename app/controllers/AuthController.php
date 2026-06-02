<?php
/**
 * CONTRÔLEUR AUTHENTIFICATION
 */

namespace Controllers;

class AuthController
{
    public function registerForm()
    {
        $view = new \View('auth/register');
        $view->display();
    }

    public function register()
    {
        // Traiter l'inscription
    }

    public function loginForm()
    {
        $view = new \View('auth/login');
        $view->display();
    }

    public function login()
    {
        // Traiter la connexion
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }

    public function forgotPasswordForm()
    {
        $view = new \View('auth/forgot-password');
        $view->display();
    }

    public function forgotPassword()
    {
        // Traiter la réinitialisation
    }
}
?>