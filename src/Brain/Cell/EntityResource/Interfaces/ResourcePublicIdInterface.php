<?php

namespace Brain\Cell\EntityResource\Interfaces;

interface ResourcePublicIdInterface
{
    /**
     * @return string|null
     */
    public function getId();

    /**
     * @return string
     */
    public function getIdOrThrow();

    /**
     * @param string $id
     */
    public function setId($id);
}
