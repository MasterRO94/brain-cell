<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Production;

use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Prototype\ResourceAliasInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Prototype\Column\Date\CreatedAtInterface;
use Brain\Cell\Prototype\Column\Date\UpdatedAtInterface;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * This represents the paper sheet (we use the term Gang)
 * used when gang printing. It just details the jobs that will be printed on
 * the gang.
 *
 * Wikipedia definition.
 * Gang-run printing describes a printing method in which multiple printing
 * projects are placed on a common paper sheet in an effort to
 * reduce printing costs and paper waste.
 */
interface GangResourceInterface extends
    ResourceIdentityInterface,
    ResourceAliasInterface,
    CreatedAtInterface,
    UpdatedAtInterface
{
    /**
     * Get the jobs that are scheduled to be printed on the gang.
     *
     * @return JobResource[]|ResourceCollection
     */
    public function getJobs(): ResourceCollection;
}
