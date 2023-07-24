<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ReflectionClass;

class Services extends Controller
{
    public static function createServiceInstance($className)
    {
        $className = "App\Http\Controllers\Services\\$className";

        if (!class_exists($className)) {
            throw new \Exception("Class '$className' does not exist.");
        }

        $reflection = new ReflectionClass($className);

        return $reflection->newInstance();
    }

    public static function createModelInstance($className)
    {
        $className = "App\Models\\$className";

        if (!class_exists($className)) {
            return null;
        }

        $reflection = new ReflectionClass($className);

        return $reflection->newInstance();
    }
}
