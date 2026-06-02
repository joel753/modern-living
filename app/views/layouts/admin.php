<?php
/**
 * ADMIN LAYOUT - Layout pour l'administration
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? SITE_NAME; ?> - Admin</title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/admin.css">
</head>
<body class="admin-layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2><?php echo SITE_NAME; ?></h2>
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li><a href="<?php echo SITE_URL; ?>/admin" class="menu-item">📊 Tableau de bord</a></li>
                <li><a href="<?php echo SITE_URL; ?>/admin/products" class="menu-item">📦 Produits</a></li>
                <li><a href="<?php echo SITE_URL; ?>/admin/orders" class="menu-item">📋 Commandes</a></li>
                <li><a href="<?php echo SITE_URL; ?>/admin/users" class="menu-item">👥 Utilisateurs</a></li>
                <li><a href="<?php echo SITE_URL; ?>/admin/categories" class="menu-item">🏷️ Catégories</a></li>
                <li><hr></li>
                <li><a href="<?php echo SITE_URL; ?>" class="menu-item">🏠 Retour au site</a></li>
                <li><a href="<?php echo SITE_URL; ?>/logout" class="menu-item">🚪 Déconnexion</a></li>
            </ul>
        </nav>
    </aside>

    <!-- CONTENU ADMIN -->
    <div class="admin-container">
        <!-- HEADER ADMIN -->
        <header class="admin-header">
            <div class="header-content">
                <h1><?php echo $title ?? 'Admin'; ?></h1>
                <div class="header-user">
                    <?php $user = $this->getCurrentUser(); ?>
                    <span>Connecté: <strong><?php echo htmlspecialchars($user->name); ?></strong></span>
                </div>
            </div>
        </header>

        <!-- MESSAGES -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                ❌ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- MAIN CONTENT -->
        <main class="admin-main">
            <?php echo $content ?? ''; ?>
        </main>
    </div>

    <script src="<?php echo SITE_URL; ?>/assets/js/admin.js"></script>
</body>
</html>
