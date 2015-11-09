<?php

namespace Brain\Cell;

interface TransformerEncoderInterface
{

    /**
     * @param TransferEntityInterface $entity
     * @return mixed
     */
    public function encode(TransferEntityInterface $entity);

}
