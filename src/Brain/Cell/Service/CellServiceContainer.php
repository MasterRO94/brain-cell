<?php

declare(strict_types=1);

namespace Brain\Cell\Service;

use Brain\Cell\Exception\Internal\ServiceNotFoundException;

use Psr\Container\ContainerInterface;

/**
 * @internal
 */
class CellServiceContainer implements ContainerInterface
{
    /** @var callable[] Of structure { [serviceName: string]: callable; } */
    private $servicesCreateFunctions = [];

    /** @var mixed[] Of structure { [serviceName: string]: mixed; } */
    private $instantiatedServices;

    public function get($id)
    {
        if (isset($this->instantiatedServices[$id])) {
            return $this->instantiatedServices[$id];
        }

        if (!$this->has($id)) {
            throw new ServiceNotFoundException(sprintf('Service "%s" is not defined.', $id));
        }

        return $this->instantiatedServices[$id] = $this->servicesCreateFunctions[$id]($this);
    }

    public function has($id)
    {
        return isset($this->servicesCreateFunctions[$id]);
    }

    public function set(string $id, callable $createFn): void
    {
        $this->servicesCreateFunctions[$id] = $createFn;
    }
}
