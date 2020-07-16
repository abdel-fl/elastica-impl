<?php

namespace App\Builder;

use App\Interfaces\CriteriaInterface;
use Elastica\Query;

/**
 * Interface ElasticaQueryBuilderInterface
 */
interface ElasticaQueryBuilderInterface
{
    /**
     * Build an instance of Elastica\Query based on the given criteria.
     *
     * @param CriteriaInterface $criteria
     *
     * @return Query
     */
    public function build(CriteriaInterface $criteria): Query;
}
