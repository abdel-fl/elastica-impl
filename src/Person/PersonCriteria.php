<?php

namespace App\Person;

use App\Traits\{
    FromArray,
    ToArrayTrait
};
use App\Interfaces\CriteriaInterface;

/**
 * Class PersonCriteria
 */
class PersonCriteria implements CriteriaInterface
{
    use ToArrayTrait, FromArray;

    /**
     * @var int
     */
    private $page = self::DEFAULT_PAGE;

    /**
     * @var int
     */
    private $limit = self::DEFAULT_LIMIT;

    /**
     * @var string|null
     */
    private $firstName;

    /**
     * @var string|null
     */
    private $lastName;


    /**
     * @var string|null
     */
    private $identityNumber;


    /**
     * @var string|null
     */
    private $emailAddress;


    /**
     * @var string|null
     */
    private $phoneNumber;

    /**
     * @var string|null
     */
    private $sort;

    /**
     * PersonCriteria constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->fromArray($data);
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     *
     * @return PersonCriteria
     */
    public function setPage(int $page): PersonCriteria
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return PersonCriteria
     */
    public function setLimit(int $limit): PersonCriteria
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     *
     * @return PersonCriteria
     */
    public function setFirstName(?string $firstName): PersonCriteria
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     *
     * @return PersonCriteria
     */
    public function setLastName(?string $lastName): PersonCriteria
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIdentityNumber(): ?string
    {
        return $this->identityNumber;
    }

    /**
     * @param string|null $identityNumber
     *
     * @return PersonCriteria
     */
    public function setIdentityNumber(?string $identityNumber): PersonCriteria
    {
        $this->identityNumber = $identityNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    /**
     * @param string|null $emailAddress
     *
     * @return PersonCriteria
     */
    public function setEmailAddress(?string $emailAddress): PersonCriteria
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     *
     * @return PersonCriteria
     */
    public function setPhoneNumber(?string $phoneNumber): PersonCriteria
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * @param string|null $sort
     *
     * @return $this
     */
    public function setSort(?string $sort): self
    {
        $this->sort = $sort;

        return $this;
    }
}
