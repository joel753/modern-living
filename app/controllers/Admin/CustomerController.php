<?php
/**
 * CONTRÔLEUR ADMIN - CLIENTS
 */

namespace Controllers\Admin;

class CustomerController
{
    public function index()
    {
        $view = new \View('admin/customers/index');
        $view->display();
    }

    public function show($id)
    {
        $view = new \View('admin/customers/show');
        $view->display();
    }
}
?>