<?php

namespace Brain\Cell\Transfer;

use Brain;
use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractCollection extends ArrayCollection implements
    Brain\Cell\TransferEntityInterface
{

    /**
     * @return string
     */
    abstract public function getResourceClassName();

}
