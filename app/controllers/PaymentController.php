<?php
/**
 * CONTRÔLEUR PAIEMENT
 */

namespace Controllers;

class PaymentController
{
    public function process()
    {
        // Traiter le paiement
    }

    public function confirmation($id)
    {
        $view = new \View('payment/confirmation');
        $view->display();
    }
}
?>