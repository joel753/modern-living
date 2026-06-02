<?php
/**
 * ROUTES DE L'APPLICATION
 */

// Accueil
$router->get('/', 'Controllers\\HomeController@index');

// Produits
$router->get('/produits', 'Controllers\\ProductController@index');
$router->get('/produit/{id}', 'Controllers\\ProductController@show');
$router->get('/categorie/{slug}', 'Controllers\\CategoryController@show');
$router->get('/search', 'Controllers\\ProductController@search');

// Panier
$router->get('/panier', 'Controllers\\CartController@index');
$router->post('/panier/ajouter', 'Controllers\\CartController@add');
$router->post('/panier/supprimer', 'Controllers\\CartController@remove');
$router->post('/panier/update', 'Controllers\\CartController@update');

// Authentification
$router->get('/inscription', 'Controllers\\AuthController@registerForm');
$router->post('/inscription', 'Controllers\\AuthController@register');
$router->get('/connexion', 'Controllers\\AuthController@loginForm');
$router->post('/connexion', 'Controllers\\AuthController@login');
$router->get('/deconnexion', 'Controllers\\AuthController@logout');
$router->get('/mot-de-passe-oublie', 'Controllers\\AuthController@forgotPasswordForm');
$router->post('/mot-de-passe-oublie', 'Controllers\\AuthController@forgotPassword');

// Paiement
$router->post('/paiement/process', 'Controllers\\PaymentController@process');
$router->get('/paiement/confirmation/{id}', 'Controllers\\PaymentController@confirmation');

// Compte utilisateur
$router->get('/mon-compte', 'Controllers\\AccountController@dashboard');
$router->get('/mes-commandes', 'Controllers\\AccountController@orders');
$router->get('/commande/{id}', 'Controllers\\AccountController@orderDetail');
$router->post('/mon-compte/update', 'Controllers\\AccountController@update');

// Administration
$router->get('/admin', 'Controllers\\Admin\\DashboardController@index');

// Produits Admin
$router->get('/admin/produits', 'Controllers\\Admin\\ProductController@index');
$router->get('/admin/produit/nouveau', 'Controllers\\Admin\\ProductController@create');
$router->post('/admin/produit', 'Controllers\\Admin\\ProductController@store');
$router->get('/admin/produit/{id}/edit', 'Controllers\\Admin\\ProductController@edit');
$router->post('/admin/produit/{id}', 'Controllers\\Admin\\ProductController@update');
$router->delete('/admin/produit/{id}', 'Controllers\\Admin\\ProductController@delete');

// Catégories Admin
$router->get('/admin/categories', 'Controllers\\Admin\\CategoryController@index');
$router->post('/admin/categorie', 'Controllers\\Admin\\CategoryController@store');
$router->post('/admin/categorie/{id}', 'Controllers\\Admin\\CategoryController@update');
$router->delete('/admin/categorie/{id}', 'Controllers\\Admin\\CategoryController@delete');

// Commandes Admin
$router->get('/admin/commandes', 'Controllers\\Admin\\OrderController@index');
$router->get('/admin/commande/{id}', 'Controllers\\Admin\\OrderController@show');
$router->post('/admin/commande/{id}/status', 'Controllers\\Admin\\OrderController@updateStatus');

// Clients Admin
$router->get('/admin/clients', 'Controllers\\Admin\\CustomerController@index');
$router->get('/admin/client/{id}', 'Controllers\\Admin\\CustomerController@show');

// Paramètres
$router->get('/admin/parametres', 'Controllers\\Admin\\SettingsController@index');
$router->post('/admin/parametres', 'Controllers\\Admin\\SettingsController@update');
?>
