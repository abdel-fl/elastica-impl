<?php

namespace App\Interfaces;

/**
 * Interface CriteriaInterface
 */
interface CriteriaInterface
{
    const DEFAULT_PAGE = 1;
    const DEFAULT_LIMIT = 20;

    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @return int
     */
    public function getLimit(): int;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return string|null
     */
    public function getSort(): ?string;
}
