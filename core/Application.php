<?php

namespace app\core;

use Cassandra\DefaultAggregate;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Responce $responce;
    public Database $db;
    public static Application $app;
    public Controller $controller;
    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app=$this;
        $this->request = new Request();
        $this->responce = new Responce();
        $this->router = new Router($this->request, $this->responce);



        $this->db = new Database($config['db']);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}