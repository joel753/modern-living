<?php
/**
 * CLASSE VIEW - Gestion des vues
 */

class View
{
    private $viewPath;
    private $data = [];

    public function __construct($viewPath)
    {
        $this->viewPath = VIEW_PATH . '/' . $viewPath . '.php';
    }

    public function with($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function render()
    {
        if (!file_exists($this->viewPath)) {
            throw new Exception('Vue non trouvée: ' . $this->viewPath);
        }

        extract($this->data);
        ob_start();
        require $this->viewPath;
        return ob_get_clean();
    }

    public function display()
    {
        echo $this->render();
    }
}
?>