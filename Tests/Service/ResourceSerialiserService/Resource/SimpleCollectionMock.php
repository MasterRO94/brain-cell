<?php

namespace Brain\Cell\Tests\Service\ResourceSerialiserService\Resource;

use Brain\Cell\Transfer\AbstractResourceCollection;

class SimpleResourceCollectionMock extends AbstractResourceCollection
{

    /**
     * {@inheritdoc}
     */
    public function getResourceClassName()
    {
        return SimpleResourceMock::CLASS;
    }


}
