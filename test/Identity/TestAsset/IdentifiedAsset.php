<?php

namespace VeritasTest\Identity\TestAsset;

use Veritas\Identity\IdentityInterface;

class IdentifiedAsset
{
    use \Veritas\Identity\IdentifiedTrait;

    public function __construct(IdentityInterface $anIdentifier)
    {
        $this->identity = $anIdentifier;
    }
}
