<?php

use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;

/**
 * @var \Bavix\Config\Config $config
 * @var \Phalcon\DiInterface $di
 */

/**
 * Shared configuration service
 */
$di->setShared('configure', function () use ($config) {
    return new \Phalcon\Config($config->get('configure')->asArray());
});

$self = $this;

$di->setShared('builder', function () use ($self) {
    return $self;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $configure = $this->getConfigure();

    $url = new UrlResolver();
    $url->setBaseUri($configure->application->baseUri);

    return $url;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $configure = $this->getConfigure();

    $params = [
        'host'     => $configure->database->host,
        'username' => $configure->database->username,
        'password' => $configure->database->password,
        'dbname'   => $configure->database->dbname,
        'charset'  => $configure->database->charset
    ];

    if ($configure->database->adapter === \Phalcon\Db\Adapter\Pdo\Postgresql::class) {
        unset($params['charset']);
    }

    $adapter = $configure->database->adapter;

    return new $adapter($params);
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {

    $view = new \Phalcon\Mvc\View();
    $view->setDI($this);

    $view->registerEngines([

        '.twig' => function (\Phalcon\Mvc\View $view) {

            /**
             * @var \Framework\Builder $builder
             */
            $builder = $this['builder'];

            $twig = new \Phalcon\Mvc\View\Engine\Twig($view, $this, [
                'cache' => BASE_PATH . '/cache/'
            ]);

            if ($builder->config()->get('app')->getData('debug', false))
            {
                $twig->getTwig()->enableDebug();
            }

            $twig->getTwig()->setLoader(
                $builder->getLoader()
            );

            return $twig;
        },

        '.phtml' => \Phalcon\Mvc\View\Engine\Php::class

    ]);

    return $view;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->set('security', function () {
    $security = new Phalcon\Security();

    // Set the password hashing factor to 12 rounds
    $security->setWorkFactor(12);

    return $security;
},
    true
);
