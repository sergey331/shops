<?php 
namespace Kernel\View;

use Kernel\Container\Container;

interface TemplateInterface
{
    public function __construct(Container $container);
     public function load($path, $data = [], $layout = 'app'): void;
}