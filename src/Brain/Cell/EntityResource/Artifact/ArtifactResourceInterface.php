<?php

namespace Brain\Cell\EntityResource\Artifact;

use Brain\Cell\EntityResource\File\FileResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Prototype\Column\Date\CreatedAtInterface;
use Brain\Cell\Prototype\Column\Date\UpdatedAtInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * An Artifact is a zip file which contains the customers uploaded files.
 * It is intended that these files should be the artwork image files, but
 * can also contain other files that may be used to construct the artwork,
 * i.e. CSV files used for personlisation of the artwork.
 * 
 * An Artifact is an alternative to assigning Artwork per component. The client
 * determines the situation in which a Job has the Artwork assigned to the
 * components or the job has an Artifact containing the Artwork.
 *
 * The structure of the zip file is determined by the client, not by Brain.
 */
interface ArtifactResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface,
    CreatedAtInterface,
    UpdatedAtInterface
{
    /**
     * A file (usually a zip) containing the Artwork
     * (or Artwork and Artwork Assembly files) that the client has uploaded.
     *
     * @return FileResourceInterface
     */
    public function getFile(): FileResourceInterface;

    /**
     * Meta-Data for the Artifact. Can be used to describe the contents of the
     * file, or the type of Artifact. The meta data is determined by the Client.
     *
     * @return array
     */
    public function getMetaData(): array;
}