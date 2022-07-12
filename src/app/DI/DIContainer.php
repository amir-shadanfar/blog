<?php

namespace App\DI;

use App\Exceptions\DependencyNotRegisteredException;
use Psr\Container\ContainerInterface;

/**
 * A psr-11 compliant container
 */
class DIContainer extends Singleton implements ContainerInterface
{
    /**
     * @var array
     */
    protected array $containers = [];

    public function __construct(protected Resolver $resolver)
    {
    }

    /**
     * @param string $id
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function get(string $id)
    {
        if (!$this->has($id)) {
            $this->containers[$id] = $this->resolver->resolve($id);
            // throw new DependencyNotRegisteredException($id);
        }
        return $this->containers[$id];
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->containers[$id]);
    }

    /**
     * @param $abstract
     * @param $concrete
     *
     * @return void
     */
    public function set($abstract, $concrete = null)
    {
        if ($concrete === null) {
            $concrete = $abstract;
        }
        $this->containers[$abstract] = $concrete;
    }
}