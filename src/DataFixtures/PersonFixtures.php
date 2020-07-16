<?php

namespace App\DataFixtures;

use Faker\{
    Factory,
    Generator
};
use App\Entity\Person;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

/**
 * Class PersonFixtures
 */
class PersonFixtures extends Fixture
{
    const PEOPLE_COUNT = 25000;

    /**
     * @var Generator
     */
    private $faker;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($index = 0; $index < self::PEOPLE_COUNT; $index++) {
            $person = (new Person())
                ->setFirstName($this->faker->firstName)
                ->setLastName($this->faker->lastName)
                ->setIdentityNumber(uniqid())
                ->setEmailAddress($this->faker->email)
                ->setPhoneNumber($this->faker->phoneNumber)
            ;

            $manager->persist($person);

            if (0 === $index % 100) {
                $manager->flush();
            }
        }

        $manager->flush();
    }
}
