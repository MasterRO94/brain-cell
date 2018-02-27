<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\Transfer\AbstractResource;

class JobMetaResource extends AbstractResource
{
    /**
     * {@inheritdoc}
     */
    public function getUnstructuredFields()
    {
        return [
            'data',
        ];
    }

    protected $data;
}
