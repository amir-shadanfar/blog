<?php

namespace App\DI;

class Resolver
{
    /**
     * @param $class
     *
     * @return mixed|object|null
     * @throws \ReflectionException
     */
    public function resolve($class)
    {
        $reflector = new \ReflectionClass($class);

        if (!$reflector->isInstantiable()) {
            throw new \Exception("[$class] is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $class;
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);

        return $reflector->newInstanceArgs($dependencies);

    }

    /**
     * @param $parameters
     *
     * @return array
     * @throws \Exception
     */
    protected function getDependencies($parameters)
    {
        $dependencies = array();

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getType();// getClass() is deprecated
            // var_dump($parameter);
            if (is_null($dependency)) {
                $dependencies[] = $this->resolveNonClass($parameter);
            } else {
                $dependencies[] = $this->resolve($dependency->getName());
            }
        }

        return $dependencies;
    }

    /**
     * @param \ReflectionParameter $parameter
     *
     * @return mixed
     * @throws \Exception
     */
    protected function resolveNonClass(\ReflectionParameter $parameter)
    {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new \Exception("Erm.. Cannot resolve the unknown!?");
    }

}
