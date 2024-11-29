<?php

namespace App\Commons;

use Illuminate\Support\Facades;

class Application
{

    const APP_DEFAULT = 'home';

    const APP_WEB = 'web';
    const APP_WAP = 'wap';

    const APP_CMS = 'cms';

    const APP_API = 'api';


    private static $instance;


    /**
     * @var string
     */
    private $name;
    private $host;

    /**
     * Returns the *Singleton* instance of this class.
     * @return Application The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;

    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    public function __construct()
    {
        $configHost = config('app.host');
        $name = isset($_SERVER['HTTP_HOST']) && isset($configHost[$_SERVER['HTTP_HOST']]) ? $configHost[$_SERVER['HTTP_HOST']] : $configHost['default'];
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    //
    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

}