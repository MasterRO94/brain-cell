<?php

namespace Brain\Cell\Transfer\Entity\User;

use Brain\Cell\Transfer\AbstractResourceCollection;

class AccessTokenResourceCollection extends AbstractResourceCollection
{

    /**
     * {@inheritdoc}
     */
    public function getResourceClassName()
    {
        return AccessTokenResource::CLASS;
    }

}
