<?php
// ================= Router / Dispatcher =================
// Pola URL: BASEURL/controller/method/param1/param2
// Contoh:   BASEURL/pengajuan/simpan

class App
{
    protected $controller = DEFAULT_CONTROLLER;
    protected $method     = DEFAULT_METHOD;
    protected $params     = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // 1. Controller
        if (isset($url[0])) {
            $file = '../app/controllers/' . ucfirst($url[0]) . 'Controller.php';
            if (file_exists($file)) {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }
        }
        require_once '../app/controllers/' . $this->controller . 'Controller.php';
        $controllerClass = $this->controller . 'Controller';
        $controllerObj   = new $controllerClass;

        // 2. Method
        if (isset($url[1])) {
            if (method_exists($controllerObj, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Parameters
        $this->params = $url ? array_values($url) : [];

        // 4. Jalankan
        call_user_func_array([$controllerObj, $this->method], $this->params);
    }

    private function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
