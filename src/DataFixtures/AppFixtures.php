<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\Employe;
use App\Entity\Entreprise;
use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($count = 0; $count < 20; ++$count) {
            $article = new Departement();
            $article->setLibelle('Titre '.$count);
            $article->setCode('Uri Fixture'.$count);
            $manager->persist($article);
        }
        for ($count = 0; $count < 20; ++$count) {
            $emp = new Employe();
            $emp->setNomComplet('Name '.$count);
            $emp->setMatricule('matricule'.$count);
            $emp->setTelephone('telephone'.$count);
            $emp->setAdresse('adresse'.$count);
            $emp->setCni('cni'.$count);
            $emp->setEmail('email'.$count);
            $emp->setEtatCivil('etat'.$count);
            $emp->setLieuNaissance('naissance'.$count);
            $emp->setNationalite('nationalite'.$count);
            $emp->setPasseport('passport'.$count);
            $emp->setSexe('sexe'.$count);
            $emp->setDateNaissance(new \DateTime('now'));
            $emp->setNoteAdditionnelle('note'.$count);
            $manager->persist($emp);
        }

        $ent = new Entreprise();
        $ent->setAdresse('douala akwa');
        $ent->setTelephone('678025958');
        $ent->setLibelle('gest-h');
        $manager->persist($ent);
        $module = new Module();
        $module->setLibelle('Portail Rh');
        $module->setCode('prh');
        $module->setPasshash('Portail Rh');
        $module->setActive(true);
        $module2 = new Module();
        $module2->setLibelle('Recrutement');
        $module2->setCode('recrutement');
        $module2->setPasshash('Portail Rh');
        $module2->setActive(true);
        $module3 = new Module();
        $module3->setLibelle('Temps & Activites');
        $module3->setCode('prh');
        $module3->setPasshash('Portail Rh');
        $module3->setActive(false);
        $module4 = new Module();
        $module4->setLibelle('Paie');
        $module4->setCode('prh');
        $module4->setPasshash('Portail Rh');
        $module4->setActive(true);
        $manager->persist($module);
        $manager->persist($module2);
        $manager->persist($module3);
        $manager->persist($module4);
        $manager->flush();
    }
}
