<?php

namespace Brain\Cell\Transfer\Meta;

use Brain\Cell\Transfer\AbstractResourceCollection;
use RuntimeException;

class MetaResourceCollection extends AbstractResourceCollection
{

    /**
     * {@inheritdoc}
     */
    public function getResourceClassName()
    {
        throw new RuntimeException(sprintf('The method "%s" should never be executed in "%s"', __METHOD__, get_called_class()));
    }

}
