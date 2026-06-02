<?php
/**
 * CONTRÔLEUR ADMIN - CATÉGORIES
 */

namespace Controllers\Admin;

class CategoryController
{
    public function index()
    {
        $view = new \View('admin/categories/index');
        $view->display();
    }

    public function store()
    {
        // Ajouter une catégorie
    }

    public function update($id)
    {
        // Modifier une catégorie
    }

    public function delete($id)
    {
        // Supprimer une catégorie
    }
}
?>