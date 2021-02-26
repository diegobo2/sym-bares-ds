<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Bares;
use App\Entity\Owners;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++)
        {
            $jobFaker = Faker\Factory::create();
            // Bar
            $bar = new Bares();
            $bar->setNombre($jobFaker->company);
            $bar->setRating(3);
            $bar->setShortDescription($jobFaker->sentence);
            $bar->setDescription($jobFaker->sentence);
            $bar->setImagen($jobFaker->imageUrl($width=640, $height=480));
            
            $manager->persist($bar);
            
            
            $owner = new Owners();
            $owner->setNombre($jobFaker->name);
            $owner->setDni("1234567$i-A");
            $owner->setEmail($jobFaker->email);
            $owner->setPhone($jobFaker->phoneNumber);
            
            $owner->setBares($bar);
            
            $manager->persist($owner);            
        
        }
        $manager->flush();
    }
}
/*
$employeer->setVCIF("82102288A");
 $employeer->setVName($jobFaker->company);
 $employeer->setVLogo($jobFaker->imageUrl($width=640, $height=480));
 $employeer->setVDescription($jobFaker->sentence);
 $employeer->setVContactName($jobFaker->name);
 $employeer->setVContactPhone($jobFaker->phoneNumber);
 $employeer->setVContactMail($jobFaker->companyEmail);
 $employeer->setVLocation($jobFaker->address);
 $employeer->setNNumberOfWorkers($jobFaker->numberBetween(0,255));
 $employeer->setCreationUser("InitialFixture");
 $employeer->setCreationDate(new \DateTime("2018-6-1"));
 $employeer->setModificationUser("InitialFixture");
 $employeer->setModificationDate(new \DateTime("2018-6-1"));
 $manager->persist($employeer);
 // Offer
 $offer = new Offers();
 $offer->setVOfferCode("ACTIVE");
 $offer->setVOfferType('full-time');
 $offer->setDActivationDate(new \DateTime("2018-6-1"));
 $offer->setDDueDate(new \DateTime("2018-6-$i"));
 $offer->setVPosition(implode(' ', $jobFaker->words(2)));
 $offer->setLtextDuties($jobFaker->sentence);
 $offer->setLtextDescription($jobFaker->paragraph);
 $offer->setVSalaray("1200");
 $offer->setLtextExperienceRequirements($jobFaker->paragraph);
 $offer->setVLocation($jobFaker->city.', '.$jobFaker->country);*/
