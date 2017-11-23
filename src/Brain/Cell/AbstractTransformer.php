<?php

namespace Brain\Cell;

use Brain\Cell\Service\TransferEntityMetaManagerService;

/**
 * An abstract for all transformers (encoders and decoders).
 */
abstract class AbstractTransformer
{
    /**
     * The {@link TransferEntityMetaManagerService}.
     *
     * @var TransferEntityMetaManagerService
     */
    protected $transferEntityMetaManager;

    /**
     * Construct a new instance of {@link AbstractTransformer}.
     *
     * @param TransferEntityMetaManagerService $manager
     */
    public function __construct(TransferEntityMetaManagerService $manager)
    {
        $this->transferEntityMetaManager = $manager;
    }
}
