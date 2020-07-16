<?php

namespace App\Utils;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ViolationsHelper
 */
class ViolationsHelper
{
    /**
     * Format constraint violation list to array.
     *
     * @param ConstraintViolationListInterface $violations
     * @param bool                             $associative
     *
     * @return array
     */
    public static function formatAsArray(ConstraintViolationListInterface $violations, bool $associative = false): array
    {
        $errorsMessages = [];
        foreach ($violations as $violation) {
            if ($associative) {
                $errorsMessages[$violation->getPropertyPath()] = $violation->getMessage();

                continue;
            }

            array_push($errorsMessages, $violation->getMessage());
        }

        return $errorsMessages;
    }
}
