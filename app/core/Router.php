<?php
/**
 * CLASSE ROUTER - Gestion du routage
 */

class Router
{
    private $routes = array();
    private $middlewares = array();

    public function loadRoutes($routesFile)
    {
        if (file_exists($routesFile)) {
            require_once $routesFile;
        } else {
            throw new Exception('Fichier de routes non trouvé: ' . $routesFile);
        }
    }

    public function get($path, $controller)
    {
        $this->routes['GET'][$path] = $controller;
    }

    public function post($path, $controller)
    {
        $this->routes['POST'][$path] = $controller;
    }

    public function put($path, $controller)
    {
        $this->routes['PUT'][$path] = $controller;
    }

    public function delete($path, $controller)
    {
        $this->routes['DELETE'][$path] = $controller;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = str_replace('/modern-living/public', '', $uri);
        if (empty($uri)) $uri = '/';

        $route = $this->matchRoute($method, $uri);

        if ($route === null) {
            http_response_code(404);
            echo 'Page non trouvée';
            return;
        }

        $this->executeRoute($route);
    }

    private function matchRoute($method, $uri)
    {
        if (!isset($this->routes[$method])) {
            return null;
        }

        foreach ($this->routes[$method] as $path => $controller) {
            $pattern = $this->pathToPattern($path);
            if (preg_match($pattern, $uri, $matches)) {
                return array('controller' => $controller, 'matches' => $matches);
            }
        }

        return null;
    }

    private function pathToPattern($path)
    {
        $pattern = preg_replace_callback('/{(\w+)}/', function($matches) {
            return '(?P<' . $matches[1] . '>[^/]+)';
        }, $path);
        return '#^' . $pattern . '$#';
    }

    private function executeRoute($route)
    {
        $parts = explode('@', $route['controller']);
        $class = $parts[0];
        $method = $parts[1];
        
        if (!class_exists($class)) {
            throw new Exception('Contrôleur non trouvé: ' . $class);
        }

        $controller = new $class();
        if (!method_exists($controller, $method)) {
            throw new Exception('Méthode non trouvée: ' . $class . '@' . $method);
        }

        // Passer les paramètres dynamiques
        $params = array_slice($route['matches'], 1);
        call_user_func_array(array($controller, $method), $params);
    }
}
?>
