<?php
/**
 * CONTRÔLEUR ADMIN - PRODUITS
 */

namespace Controllers\Admin;

class ProductController
{
    public function index()
    {
        $view = new \View('admin/products/index');
        $view->display();
    }

    public function create()
    {
        $view = new \View('admin/products/create');
        $view->display();
    }

    public function store()
    {
        // Ajouter un produit
    }

    public function edit($id)
    {
        $view = new \View('admin/products/edit');
        $view->display();
    }

    public function update($id)
    {
        // Modifier un produit
    }

    public function delete($id)
    {
        // Supprimer un produit
    }
}
?>