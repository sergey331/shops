<?php 
namespace Kernel\View\interface;

use Kernel\Container\Container;

interface TemplateInterface
{
    public function __construct(Container $container);
     public function load($path, $data = [], $layout = 'app'): void;
}