<?php

namespace App\Traits;

/**
 * Trait FromArray
 */
trait FromArray
{
    /**
     * Hydrate object properties by the given data.
     *
     * @param array $data
     */
    protected function fromArray(array $data = []): void
    {
        foreach ($data as $field => $value) {
            $setter = sprintf('set%s', ucfirst($field));
            if (is_callable([$this, $setter])) {
                $this->{$setter}($value);

                continue;
            }

            if (property_exists($this, $field)) {
                $this->{$field} = $value;
            }
        }
    }
}
