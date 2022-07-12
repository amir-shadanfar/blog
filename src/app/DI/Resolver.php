<?php

namespace App\DI;

class Resolver
{
    /**
     * @param string $class
     *
     * @return object
     * @throws \ReflectionException
     */
    public function resolve(string $class): object
    {
        $reflectionClass = new \ReflectionClass($class);

        if (($constructor = $reflectionClass->getConstructor()) === null) {
            return $reflectionClass->newInstance();
        }

        if (($params = $constructor->getParameters()) === []) {
            return $reflectionClass->newInstance();
        }

        $newInstanceParams = [];
        foreach ($params as $param) {
            $newInstanceParams[] = $param->getType()->isBuiltin() ?
                $param->getDefaultValue() :
                $this->resolve($param->getType()->getName());
        }

        return $reflectionClass->newInstanceArgs(
            $newInstanceParams
        );
    }

}
