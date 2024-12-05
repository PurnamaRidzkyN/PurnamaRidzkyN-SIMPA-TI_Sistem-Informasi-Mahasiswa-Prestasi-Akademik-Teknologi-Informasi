<?php

namespace app\cores;

class RouteNode
{
    public array $children = [];
    public array $handler = [];
    public array $params = [];
    public array $middlewares = [];

    
}