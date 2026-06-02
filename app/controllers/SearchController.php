<?php
namespace controllers;

use Controller;

/**
 * SEARCH CONTROLLER - Recherche et filtrage dynamiques
 */
class SearchController extends Controller {
    
    /**
     * Effectuer une recherche
     */
    public function index() {
        $keyword = $_GET['q'] ?? '';
        $category = $_GET['category'] ?? null;
        $minPrice = $_GET['min_price'] ?? 0;
        $maxPrice = $_GET['max_price'] ?? 999999;
        $sort = $_GET['sort'] ?? 'newest';
        $page = $_GET['page'] ?? 1;
        $perPage = 12;

        $results = [];

        // Rechercher les produits
        if (!empty($keyword)) {
            $results = \Product::search($keyword);
        } else {
            $results = \Product::available();
        }

        // Filtrer par catégorie
        if ($category) {
            $results = array_filter($results, function($p) use ($category) {
                return $p->category_id == $category;
            });
        }

        // Filtrer par prix
        $results = array_filter($results, function($p) use ($minPrice, $maxPrice) {
            return $p->price >= $minPrice && $p->price <= $maxPrice;
        });

        // Trier
        usort($results, function($a, $b) use ($sort) {
            switch ($sort) {
                case 'price_asc':
                    return $a->price <=> $b->price;
                case 'price_desc':
                    return $b->price <=> $a->price;
                case 'name':
                    return strcmp($a->name, $b->name);
                case 'newest':
                default:
                    return strtotime($b->created_at) <=> strtotime($a->created_at);
            }
        });

        // Paginer
        $total = count($results);
        $pages = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;
        $results = array_slice($results, $offset, $perPage);

        // Obtenir les catégories pour les filtres
        $categories = \Category::all();

        $this->render('shop/search', [
            'products' => $results,
            'keyword' => $keyword,
            'category' => $category,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'sort' => $sort,
            'page' => $page,
            'totalPages' => $pages,
            'total' => $total,
            'categories' => $categories,
            'title' => 'Résultats de recherche'
        ], 'shop');
    }

    /**
     * Obtenir les suggestions (AJAX)
     */
    public function suggestions() {
        $keyword = $_GET['q'] ?? '';
        
        if (strlen($keyword) < 2) {
            $this->json([]);
        }

        $suggestions = \Product::search($keyword);
        $data = array_map(function($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->price
            ];
        }, array_slice($suggestions, 0, 10));

        $this->json($data);
    }

    /**
     * Filtre dynamique (AJAX)
     */
    public function filter() {
        $category = $_POST['category'] ?? null;
        $minPrice = $_POST['min_price'] ?? 0;
        $maxPrice = $_POST['max_price'] ?? 999999;
        $sort = $_POST['sort'] ?? 'newest';

        $products = \Product::available();

        if ($category) {
            $products = array_filter($products, function($p) use ($category) {
                return $p->category_id == $category;
            });
        }

        $products = array_filter($products, function($p) use ($minPrice, $maxPrice) {
            return $p->price >= $minPrice && $p->price <= $maxPrice;
        });

        usort($products, function($a, $b) use ($sort) {
            switch ($sort) {
                case 'price_asc':
                    return $a->price <=> $b->price;
                case 'price_desc':
                    return $b->price <=> $a->price;
                case 'name':
                    return strcmp($a->name, $b->name);
                default:
                    return 0;
            }
        });

        $html = '';
        foreach ($products as $product) {
            $html .= '<div class="product-card">';
            $html .= '<h3>' . htmlspecialchars($product->name) . '</h3>';
            $html .= '<p>' . htmlspecialchars(substr($product->description, 0, 100)) . '...</p>';
            $html .= '<p class="price">' . number_format($product->price, 2, ',', ' ') . ' €</p>';
            $html .= '<a href="' . SITE_URL . '/product/' . $product->id . '/show" class="btn">Voir détail</a>';
            $html .= '</div>';
        }

        $this->json([
            'success' => true,
            'count' => count($products),
            'html' => $html
        ]);
    }
}
?>
