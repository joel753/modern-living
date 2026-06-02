<?php
/**
 * CONTRÔLEUR ADMIN - PARAMÈTRES
 */

namespace Controllers\Admin;

class SettingsController
{
    public function index()
    {
        $view = new \View('admin/settings');
        $view->display();
    }

    public function update()
    {
        // Mettre à jour les paramètres
    }
}
?>