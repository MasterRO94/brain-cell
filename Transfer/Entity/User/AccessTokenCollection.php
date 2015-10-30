<?php

namespace Brain\Cell\Transfer\Entity\User;

use Brain\Cell\Transfer\AbstractCollection;

class AccessTokenCollection extends AbstractCollection
{

    /**
     * {@inheritdoc}
     */
    public function getResourceClassName()
    {
        return AccessTokenResource::CLASS;
    }

}
