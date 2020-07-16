<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"person_list", "elastica", "person_create"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     *
     * @Groups({"person_list", "elastica", "person_create"})
     *
     * @Assert\NotBlank(groups={"create"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=128)
     *
     * @Groups({"person_list", "elastica", "person_create"})
     *
     * @Assert\NotBlank(groups={"create"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=16)
     *
     * @Groups({"person_list", "elastica", "person_create"})
     *
     * @Assert\NotBlank(groups={"create"})
     */
    private $identityNumber;

    /**
     * @ORM\Column(type="string", length=128)
     *
     * @Groups({"person_list", "elastica", "person_create"})
     *
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Email(groups={"create"})
     */
    private $emailAddress;

    /**
     * @ORM\Column(type="string", length=32)
     *
     * @Groups({"person_list", "elastica", "person_create"})
     *
     * @Assert\NotBlank(groups={"create"})
     */
    private $phoneNumber;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName): self
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
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName(string $lastName): self
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
     * @param string $identityNumber
     *
     * @return $this
     */
    public function setIdentityNumber(string $identityNumber): self
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
     * @param string $emailAddress
     *
     * @return $this
     */
    public function setEmailAddress(string $emailAddress): self
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
     * @param string $phoneNumber
     *
     * @return $this
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
