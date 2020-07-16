<?php

namespace App\Person;

use App\Entity\Person;
use Doctrine\ORM\ORMException;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface PersonManagerInterface
 */
interface PersonManagerInterface
{
    /**
     * Create & hydrate a new person with given data.
     *
     * @param array $data
     *
     * @return Person
     *
     * @throws PersonDomainException
     */
    public function createPerson(array $data): Person;

    /**
     * Persist the given person & flush changes to database if true = $flush.
     *
     * @param Person $person
     * @param bool   $flush
     *
     * @return Person
     *
     * @throws ORMException
     */
    public function savePerson(Person $person, bool $flush = true): Person;

    /**
     * Fetch people base on given criteria.
     *
     * @param PersonCriteria $criteria
     *
     * @return PaginationInterface
     */
    public function fetchPeople(PersonCriteria $criteria): PaginationInterface;
}
