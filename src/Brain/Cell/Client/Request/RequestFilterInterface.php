<?php

namespace Brain\Cell\Client\Request;

interface RequestFilterInterface
{
    /**
     * Return the request filters.
     *
     * @return mixed[]
     */
    public function getFilters(): array;

    /**
     * Return the request parameters.
     *
     * @return mixed[]
     */
    public function getParameters(): array;
}
