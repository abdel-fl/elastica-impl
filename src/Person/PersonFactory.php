<?php

namespace App\Person;

use App\Entity\Person;

/**
 * Class PersonFactory
 */
class PersonFactory
{
    /**
     * @return Person
     */
    public static function create(): Person
    {
        return new Person();
    }
}
