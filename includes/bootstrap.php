<?php

class Config
{
    public static $config;

    /**
     * 加载Config.
     */
    public static function load()
    {
        $config = include ROOT . '/includes/config.php';
        self::setConfig($config);
    }

    public static function setConfig($config)
    {
        self::$config = $config;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public static function get($key)
    {
        if (!isset(self::$config)) {
            self::load();
        }
        if (isset(self::$config[$key])) {
            return self::$config[$key];
        }
        return false;
    }
}

/**
 * Class ControllerInterface
 */
abstract class ControllerInterface
{
    public $db;
    private $args;
    private $template; // 每个控制器一定会有一个模板.

    abstract public function initTemplate();
    abstract public function initOutput();

    public function __construct($path = '')
    {
        $db_config = Config::get('db');
        $site_config = Config::get('site_default');

        $this->db = new DB(
            $db_config['host'],
            $db_config['user'],
            $db_config['pass'],
            $db_config['name']
        );
        
        if ($this->db->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') '
                    . $mysqli->connect_error);
        }

        $this->setTemplate($path, $site_config);
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function setTemplate($template, $args = array())
    {
        $this->setArgs($args);
        $this->template = ROOT . '/templates/' . $template . '.php';
    }

    /**
     * return template file.
     *
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * 根据你的模板去展示.
     */
    public function display()
    {
        $this->initTemplate();
        $this->initOutput();
        
        $html = file_get_contents($this->getTemplate());
        foreach ($this->getArgs() as $key => $val) {
            $html=str_replace('{{ $'.$key.' }}', $val, $html);
        }

        echo $html;
    }
}

class Client
{
    public $controller;

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function getController()
    {
        return $this->controller;
    }

    /**
     * 这个函数的用处就是
     *
     * @param $path
     *
     * @return string
     */
    public function routerDisplay($path)
    {
        try {
            // $path = index.
            $contoller_path = ROOT . '/controller/';
            $contoller = ucfirst($path) . 'Controller';
            $controller_file = $contoller_path . $contoller . '.php';
            if (!file_exists($controller_file)) {
                throw new Exception('Page not found.');
            }
            include $controller_file;
            $this->setController(new $contoller($path));
            return $this->getController()->display();
        } catch (Exception $e) {
            // 返回异常信息.
            return $e->getMessage();
        }
    }

    /**
     * 初始化.
     */
    public function display()
    {
        $path = isset($_GET['action']) ? $_GET['action'] : '';
        print $this->routerDisplay($path);
    }
}
