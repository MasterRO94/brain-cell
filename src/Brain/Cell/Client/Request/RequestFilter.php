<?php

namespace Brain\Cell\Client\Request;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * A basic request filter.
 */
final class RequestFilter implements RequestFilterInterface
{
    private $filters;
    private $parameters;

    public function __construct()
    {
        $this->filters = new ParameterBag();
        $this->parameters = new ParameterBag();
    }

    /**
     * Return the filter bag.
     */
    public function filters(): ParameterBag
    {
        return $this->filters;
    }

    /**
     * Return the parameter bag.
     */
    public function parameters(): ParameterBag
    {
        return $this->parameters;
    }

    /**
     * Apply a page limit.
     */
    public function setPaginationLimit(int $limit): void
    {
        $this->parameters->set('limit', $limit);
    }

    /**
     * Target a specific page.
     */
    public function setPaginationPage(int $page): void
    {
        $this->parameters->set('page', $page);
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters(): array
    {
        return $this->filters->all();
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters(): array
    {
        return $this->parameters->all();
    }
}
