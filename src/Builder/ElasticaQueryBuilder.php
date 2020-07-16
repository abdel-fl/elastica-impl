<?php

namespace App\Builder;

use App\{
    Interfaces\CriteriaInterface,
    Utils\CriteriaHelper
};
use Elastica\{
    Query,
    Query\BoolQuery,
    Query\Match
};

/**
 * Class ElasticaQueryBuilder
 */
class ElasticaQueryBuilder implements ElasticaQueryBuilderInterface
{
    /**
     * @var BoolQuery
     */
    private $boolQuery;

    /**
     * @var Query
     */
    private $query;

    /**
     * {@inheritDoc}
     */
    public function build(CriteriaInterface $criteria): Query
    {
        $this->boolQuery = new BoolQuery();
        $this->query = new Query();

        $this->applyFilters($criteria);
        $this->applySorts($criteria);

        $this->query->setQuery($this->boolQuery);

        return $this->query;
    }

    /**
     * @param CriteriaInterface $criteria
     */
    protected function applyFilters(CriteriaInterface $criteria): void
    {
        $filters = CriteriaHelper::filterCriteria($criteria);
        foreach ($filters as $field => $value) {
            $this->applyFilter($field, $value);
        }
    }

    /**
     * @param CriteriaInterface $criteria
     */
    protected function applySorts(CriteriaInterface $criteria): void
    {
        $sorts = CriteriaHelper::formatSort($criteria);
        foreach ($sorts as $field => $direction) {
            $this->applySort($field, $direction);
        }
    }

    /**
     * @param string $field
     * @param mixed  $value
     */
    protected function applyFilter(string $field, $value): void
    {
        $this->boolQuery->addMust(
            new Match($field, $value)
        );
    }

    /**
     * @param string $field
     * @param string $direction
     */
    protected function applySort(string $field, string $direction): void
    {
        $this->query->addSort([$field => ['order' => $direction]]);
    }
}
