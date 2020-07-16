<?php

namespace App\Traits;

/**
 * Trait ToArrayTrait
 */
trait ToArrayTrait
{
    /**
     * Convert object properties to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
