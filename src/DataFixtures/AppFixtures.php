<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\Employe;
use App\Entity\Entreprise;
use App\Entity\Module;
use App\Entity\RhCategorieRegle;
use App\Entity\Rhreglesalaire;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        /*for ($count = 0; $count < 20; ++$count) {
            $article = new Departement();
            $article->setLibelle('Titre '.$count);
            $article->setCode('Uri Fixture'.$count);
            $manager->persist($article);
        }*/
        $rhcategorieRegle = new RhCategorieRegle();
        $rhcategorieRegle->setLibelle('Basic');
        $rhcategorieRegle->setCode('BASIC');
        $rhcategorieRegle->setDescription('base de regle');
        $rhcategorieRegle->setOperation('basic');

        $rhcategorieRegle2 = new RhCategorieRegle();
        $rhcategorieRegle2->setLibelle('Net');
        $rhcategorieRegle2->setCode('Net');
        $rhcategorieRegle2->setDescription('base de regle');
        $rhcategorieRegle2->setOperation('net');

        $rhcategorieRegle3 = new RhCategorieRegle();
        $rhcategorieRegle3->setLibelle('Allocation');
        $rhcategorieRegle3->setCode('ALL');
        $rhcategorieRegle3->setDescription('base de regle');
        $rhcategorieRegle3->setOperation('allocation');

        $rhcategorieRegle4 = new RhCategorieRegle();
        $rhcategorieRegle4->setLibelle('Deduction');
        $rhcategorieRegle4->setCode('DED');
        $rhcategorieRegle4->setDescription('base de regle');
        $rhcategorieRegle4->setOperation('deduction');

        $rhcategorieRegle5 = new RhCategorieRegle();
        $rhcategorieRegle5->setLibelle('Allocation-net');
        $rhcategorieRegle5->setCode('ALL-NET');
        $rhcategorieRegle5->setDescription('base de regle');
        $rhcategorieRegle5->setOperation('allocation');

        $rhcategorieRegle6 = new RhCategorieRegle();
        $rhcategorieRegle6->setLibelle('Deduction-net');
        $rhcategorieRegle6->setCode('DED-NET');
        $rhcategorieRegle6->setDescription('base de regle');
        $rhcategorieRegle6->setOperation('deduction');

        $rhcategorieRegle7 = new RhCategorieRegle();
        $rhcategorieRegle7->setLibelle('Brut');
        $rhcategorieRegle7->setCode('BRUT');
        $rhcategorieRegle7->setDescription('base de regle');
        $rhcategorieRegle7->setOperation('net');
        $manager->persist($rhcategorieRegle);
        $manager->persist($rhcategorieRegle2);
        $manager->persist($rhcategorieRegle3);
        $manager->persist($rhcategorieRegle4);
        $manager->persist($rhcategorieRegle5);
        $manager->persist($rhcategorieRegle6);
        $manager->persist($rhcategorieRegle7);
        /*regle salaire*/
        $rhRegle = new Rhreglesalaire();
        $rhRegle->setRhcategorieregle($rhcategorieRegle);
        $rhRegle->setLibelle('Salaire de base');
        $rhRegle->setCode('SAB');
        $rhRegle->setDescription('pour creer le salaire de base');
        $rhRegle->setSequencecalcul(1);
        $rhRegle->setIsvisible(true);
        $rhRegle->setQuantite(1);
        $rhRegle->setPourcentage(null);
        $rhRegle->setMontantfixe(null);
        $rhRegle->setRegistrecontribution(null);
        $rhRegle->setPlagemin(null);
        $rhRegle->setPlagemax(null);
        $rhRegle->setPlagesur(null);
        $rhRegle->setPourcentagesur(null);
        $rhRegle->setCodecalcul('contrat');
        $rhRegle->setRhcondition('toujours');
        $rhRegle->setTypecondition('expression');
        $rhRegle2 = new Rhreglesalaire();
        $rhRegle2->setRhcategorieregle($rhcategorieRegle2);
        $rhRegle2->setLibelle('Salaire net');
        $rhRegle2->setCode('SAN');
        $rhRegle2->setDescription('pour creer le salaire de base');
        $rhRegle2->setSequencecalcul(200);
        $rhRegle2->setIsvisible(true);
        $rhRegle2->setQuantite(1);
        $rhRegle2->setPourcentage(null);
        $rhRegle2->setMontantfixe(null);
        $rhRegle2->setRegistrecontribution(null);
        $rhRegle2->setPlagemin(null);
        $rhRegle2->setPlagemax(null);
        $rhRegle2->setPlagesur(null);
        $rhRegle2->setPourcentagesur(null);
        $rhRegle2->setCodecalcul('cat.BASIC+cat.ALL+cat.DED');
        $rhRegle2->setRhcondition('toujours');
        $rhRegle2->setTypecondition('expression');
        $rhRegle3 = new Rhreglesalaire();
        $rhRegle3->setRhcategorieregle($rhcategorieRegle7);
        $rhRegle3->setLibelle('Salaire Brut');
        $rhRegle3->setCode('SABR');
        $rhRegle3->setDescription('pour creer le salaire de base');
        $rhRegle3->setSequencecalcul(100);
        $rhRegle3->setIsvisible(true);
        $rhRegle3->setQuantite(1);
        $rhRegle3->setPourcentage(null);
        $rhRegle3->setMontantfixe(null);
        $rhRegle3->setRegistrecontribution(null);
        $rhRegle3->setPlagemin(null);
        $rhRegle3->setPlagemax(null);
        $rhRegle3->setPlagesur(null);
        $rhRegle3->setPourcentagesur(null);
        $rhRegle3->setCodecalcul('cat.BASIC+cat.ALL');
        $rhRegle3->setRhcondition('toujours');
        $rhRegle3->setTypecondition('expression');

        $rhRegle4 = new Rhreglesalaire();
        $rhRegle4->setRhcategorieregle($rhcategorieRegle4);
        $rhRegle4->setLibelle('Remboursement Avance salaire');
        $rhRegle4->setCode('SABR');
        $rhRegle4->setDescription('pour creer le salaire net');
        $rhRegle4->setSequencecalcul(20);
        $rhRegle4->setIsvisible(true);
        $rhRegle4->setQuantite(1);
        $rhRegle4->setPourcentage(null);
        $rhRegle4->setMontantfixe(null);
        $rhRegle4->setRegistrecontribution(null);
        $rhRegle4->setPlagemin(null);
        $rhRegle4->setPlagemax(null);
        $rhRegle4->setPlagesur(null);
        $rhRegle4->setPourcentagesur(null);
        $rhRegle4->setCodecalcul('refund');
        $rhRegle4->setRhcondition('toujours');
        $rhRegle4->setTypecondition('expression');
        $manager->persist($rhRegle);
        $manager->persist($rhRegle2);
        $manager->persist($rhRegle3);
        $manager->persist($rhRegle4);
        /*departement*/
        $departement = new Departement();
        $departement->setLibelle('informatique');
        $departement->setCode('info');
        $manager->persist($departement);
        /*employe*/
        $employe = new Employe();
        $employe->setNomComplet('Administrateur ');
        $employe->setMatricule('inf0001');
        $employe->setTelephone('telephone');
        $employe->setAdresse('adresse');
        $employe->setCni('cni');
        $employe->setEmail('admin@gmail.com');
        $employe->setEtatCivil('celibataire');
        $employe->setLieuNaissance('naissance');
        $employe->setNationalite('camerounaise');
        $employe->setPasseport('passport');
        $employe->setSexe('Masculin');
        $employe->setDateNaissance(new \DateTime('now'));
        $employe->setNoteAdditionnelle('note');
        $manager->persist($employe);
        /*user*/
        $user = new User();
        $user->setEmploye($employe);
        $user->setEmail('admin@gmail.com');
        $user->setPlainPassword('admin');
        $user->setUsername('admin');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $manager->persist($user);
        /*entreprise*/
        $ent = new Entreprise();
        $ent->setAdresse('douala akwa');
        $ent->setTelephone('678025958');
        $ent->setLibelle('gest-h');
        $manager->persist($ent);
        /*modules*/
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
