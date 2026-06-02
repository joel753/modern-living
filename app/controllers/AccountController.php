<?php
/**
 * CONTRÔLEUR COMPTE UTILISATEUR
 */

namespace Controllers;

class AccountController
{
    public function dashboard()
    {
        $view = new \View('account/dashboard');
        $view->display();
    }

    public function orders()
    {
        $view = new \View('account/orders');
        $view->display();
    }

    public function orderDetail($id)
    {
        $view = new \View('account/order-detail');
        $view->display();
    }

    public function update()
    {
        // Mettre à jour le profil
    }
}
?>