<?php
/**
 * CONTRÔLEUR ADMIN - COMMANDES
 */

namespace Controllers\Admin;

class OrderController
{
    public function index()
    {
        $view = new \View('admin/orders/index');
        $view->display();
    }

    public function show($id)
    {
        $view = new \View('admin/orders/show');
        $view->display();
    }

    public function updateStatus($id)
    {
        // Mettre à jour le statut
    }
}
?>