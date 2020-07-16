<?php

namespace App\Person;

use App\{
    Entity\Person,
    Repository\PersonRepository,
    Utils\ViolationsHelper,
    Builder\ElasticaQueryBuilderInterface
};
use Knp\Component\Pager\{
    Pagination\PaginationInterface,
    PaginatorInterface
};
use Doctrine\ORM\ORMException;
use Symfony\Component\Form\FormFactoryInterface;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class PersonManager
 */
class PersonManager implements PersonManagerInterface
{
    /**
     * @var PaginatedFinderInterface
     */
    private  $personFinder;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * @var ElasticaQueryBuilderInterface
     */
    private $elasticaQueryBuilder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var PersonRepository
     */
    protected $personRepository;

    /**
     * PersonManager constructor.
     *
     * @param PaginatedFinderInterface      $personFinder
     * @param PaginatorInterface            $paginator
     * @param ElasticaQueryBuilderInterface $elasticaQueryBuilder
     * @param ValidatorInterface            $validator
     * @param FormFactoryInterface          $formFactory
     * @param PersonRepository              $personRepository
     */
    public function __construct(PaginatedFinderInterface $personFinder, PaginatorInterface $paginator, ElasticaQueryBuilderInterface $elasticaQueryBuilder, ValidatorInterface $validator, FormFactoryInterface $formFactory, PersonRepository $personRepository)
    {
        $this->personFinder = $personFinder;
        $this->paginator = $paginator;
        $this->elasticaQueryBuilder = $elasticaQueryBuilder;
        $this->validator = $validator;
        $this->formFactory = $formFactory;
        $this->personRepository = $personRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function createPerson(array $data): Person
    {
        $person = PersonFactory::create();
        $form = $this->formFactory->create(PersonType::class, $person);
        $form->submit($data);
        $this->validatePerson($person, 'create');

        return $person;
    }

    /**
     * @param Person $person
     * @param bool   $flush
     *
     * @return Person
     *
     * @throws ORMException
     */
    public function savePerson(Person $person, bool $flush = true): Person
    {
        return $this->personRepository->persist($person, $flush);
    }

    /**
     * {@inheritDoc}
     */
    public function fetchPeople(PersonCriteria $criteria): PaginationInterface
    {
        $query = $this->elasticaQueryBuilder->build($criteria);

        return $this->paginator->paginate(
            $this->personFinder->createPaginatorAdapter($query),
            $criteria->getPage(),
            $criteria->getLimit()
        );
    }

    /**
     * @param Person $person
     * @param string $group
     *
     * @throws PersonDomainException
     */
    private function validatePerson(Person $person, string $group): void
    {
        $violations = $this->validator->validate($person, null, [$group]);

        if (0 === $violations->count()) {
            return;
        }

        throw new PersonDomainException(
            PersonDomainException::FORM_VALIDATION_ERROR_MESSAGE,
            PersonDomainException::FORM_VALIDATION_ERROR_CODE,
            ViolationsHelper::formatAsArray($violations, true)
        );
    }
}
