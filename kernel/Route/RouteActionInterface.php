<?php

namespace Kernel\Route;

interface RouteActionInterface
{
    public function getAction(array $routers);
}