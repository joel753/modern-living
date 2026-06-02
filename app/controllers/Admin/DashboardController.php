<?php
/**
 * CONTRÔLEUR ADMIN - TABLEAU DE BORD
 */

namespace Controllers\Admin;

class DashboardController
{
    public function index()
    {
        $view = new \View('admin/dashboard');
        $view->display();
    }
}
?>