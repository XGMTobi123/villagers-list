<?php

namespace app\core;

class Router
{
    public Request $request;
    public Responce $responce;

    protected array $routes = [];

    public function __construct(Request $request, Responce $responce)
    {
        $this->request = $request;
        $this->responce = $responce;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback===false){
            $this->responce->setStatusCode(404);
            return $this->renderView(404);
        }
        if (is_string($callback)){
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        if ($view == "404"){
            $this->responce->setStatusCode(404);
        }
        return str_replace('{{content}}', $viewContent,$layoutContent);
    }

    public function renderAjax($view, $params = [])
    {
        return $this->renderOnlyView($view, $params);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent,$layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout ?? 'main';
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        //var_dump($name);
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}