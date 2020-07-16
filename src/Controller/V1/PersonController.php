<?php

namespace App\Controller\V1;

use App\Person\{
    PersonCriteria,
    PersonDomainException,
    PersonManagerInterface
};
use FOS\RestBundle\{
    Controller\AbstractFOSRestController,
    Controller\Annotations as Rest,
    Request\ParamFetcherInterface
};
use FOS\RestBundle\View\View;
use Psr\Log\LoggerInterface;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PersonController
 *
 * @Rest\Route("people")
 */
class PersonController extends AbstractFOSRestController
{
    /**
     * @var PersonManagerInterface
     */
    protected $personManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * PersonController constructor.
     *
     * @param PersonManagerInterface $personManager
     * @param LoggerInterface        $logger
     */
    public function __construct(PersonManagerInterface $personManager, LoggerInterface $logger)
    {
        $this->personManager = $personManager;
        $this->logger = $logger;
    }

    /**
     * @param ParamFetcherInterface $paramFetcher
     *
     * @SWG\Tag(name="people")
     * @SWG\Response(response="200", description="List of filtered people.")
     *
     * @Rest\QueryParam(name="page", requirements="\d+", default=1)
     * @Rest\QueryParam(name="limit", requirements="\d+", default=20)
     *
     * @Rest\QueryParam(name="firstName", nullable=true, allowBlank=false)
     * @Rest\QueryParam(name="lastName", nullable=true, allowBlank=false)
     * @Rest\QueryParam(name="identityNumber", nullable=true, allowBlank=false)
     * @Rest\QueryParam(name="emailAddress", nullable=true, allowBlank=false)
     * @Rest\QueryParam(name="phoneNumber", nullable=true, allowBlank=false)
     * @Rest\QueryParam(name="sort", nullable=true, allowBlank=false, default="id:asc")
     *
     * @Rest\Get()
     *
     * @Rest\View(serializerGroups={"person_list", "paginator"}, statusCode=200)
     *
     * @return View
     */
    public function getPeople(ParamFetcherInterface $paramFetcher): View
    {
        try {
            $criteria = new PersonCriteria($paramFetcher->all());

            return $this->view(
                $this->personManager->fetchPeople($criteria),
                Response::HTTP_OK
            );
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]);

            return $this->view('An error occurred while processing this request. please try again later !', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param ParamFetcherInterface $paramFetcher
     *
     * @Rest\Post()
     *
     * @SWG\Tag(name="people")
     * @SWG\Response(response="201", description="Created person.")
     *
     * @Rest\RequestParam(name="firstName", nullable=false, allowBlank=false)
     * @Rest\RequestParam(name="lastName", nullable=false, allowBlank=false)
     * @Rest\RequestParam(name="identityNumber", nullable=false, allowBlank=false)
     * @Rest\RequestParam(name="emailAddress", nullable=false, allowBlank=false)
     * @Rest\RequestParam(name="phoneNumber", nullable=false, allowBlank=false)
     *
     * @Rest\View(serializerGroups={"person_create"}, statusCode=201)
     *
     * @return View
     */
    public function postPerson(ParamFetcherInterface $paramFetcher): View
    {
        try {
            $person = $this->personManager->createPerson($paramFetcher->all());
            $person = $this->personManager->savePerson($person);

            return $this->view($person, Response::HTTP_CREATED);
        } catch (PersonDomainException $exception) {
            $this->logger->error($exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'data' => $exception->getData(),
                'trace' => $exception->getTraceAsString(),
            ]);

            return $this->view([
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'errors' => $exception->getData(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]);

            return $this->view( 'An error occurred while processing this request. please try again later !', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
