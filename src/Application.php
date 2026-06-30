<?php

declare(strict_types=1);

namespace Invo;

use Exception;
use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Application as MvcApplication;

class Application
{
    protected MvcApplication $app;
    protected DiInterface $di;
    protected string $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;

        $this->di = new FactoryDefault();
        $this->di->offsetSet('rootPath', function () use ($rootPath) {
            return $rootPath;
        });

        $this->app = new MvcApplication($this->di);

        $this->initializeProviders();
    }

    public function getRootPath(): string
    {
        return $this->rootPath;
    }

    public function run(): string
    {
        /** @var ResponseInterface $response */
        $response = $this->app->handle($_SERVER['REQUEST_URI']);

        return (string) $response->getContent();
    }

    protected function initializeProviders(): void
    {
        $filename = $this->rootPath . '/config/providers.php';
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new Exception('File providers.php does not exist or is not readable.');
        }

        $providers = require $filename;
        foreach ($providers as $providerClass) {
            $this->di->register(new $providerClass());
        }
    }
}
