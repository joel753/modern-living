<?php
/**
 * CONTRÔLEUR CATÉGORIES
 */

namespace Controllers;

class CategoryController
{
    public function show($slug)
    {
        $view = new \View('category/show');
        $view->display();
    }
}
?>