<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Cv;
use App\Entity\Diploma;
use App\Entity\Hobby;
use App\Entity\Language;
use App\Entity\ProfessionalExperience;
use App\Entity\Skill;

class CvController extends AbstractController
{
    #[Route('/cv', name: 'app_cv')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $session = $request->getSession();
        $userSession = $session->get('user');

        $cv = null;

        if ($userSession) {
            $cvRepository = $doctrine->getRepository(Cv::class);

            $cv = $cvRepository->find($userSession->getCv()->getId());
        }


        return $this->render('cv/index.html.twig', [
            'cv' => $cv,
        ]);
    }

    #[Route('/cv/create', name: 'app_cv_create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $session = $request->getSession();
        $userSession = $session->get('user');

        $entityManager = $doctrine->getManager();
        
        $diplomaRepository = $doctrine->getRepository(Diploma::class);
        $diplomas = $diplomaRepository->findAll();

        $skillRepository = $doctrine->getRepository(Skill::class);
        $skills = $skillRepository->findAll();

        $hobbyRepository = $doctrine->getRepository(Hobby::class);
        $hobbies = $hobbyRepository->findAll();

        $languageRepository = $doctrine->getRepository(Language::class);
        $languages = $languageRepository->findAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $postal = $_POST['postal'];
            $tel = $_POST['tel'];
            $linkedin = $_POST['linkedin'];
            $diploma = $_POST['diploma'];
            $skill = $_POST['skill'];
            $hobby = $_POST['hobby'];
            $language = $_POST['language'];
            $color_first = $_POST['color_first'];
            $color_second = $_POST['color_second'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $place = $_POST['place'];
            $date_begin = $_POST['date_begin'];
            $date_end = $_POST['date_end'];

            if (isset($name) && isset($description) && isset($place) && isset($date_begin) && isset($date_end)) {
                $cv = new Cv();
                $cv->setFirstname($firstname);
                $cv->setLastname($lastname);
                $cv->setEmail($email);
                $cv->setPostal($postal);
                $cv->setTel($tel);
                $cv->setLinkedin($linkedin);
                $cv->addDiploma($diplomaRepository->find($diploma));
                $cv->addSkill($skillRepository->find($skill));
                $cv->addHobby($hobbyRepository->find($hobby));
                $cv->addLanguage($languageRepository->find($language));
                $cv->setColorFirst($color_first);
                $cv->setColorSecond($color_second);

                $professionalExperience = new ProfessionalExperience();
                $professionalExperience->setName($name);
                $professionalExperience->setDescription($description);
                $professionalExperience->setPlace($place);
                $professionalExperience->setDateBegin($date_begin);
                $professionalExperience->setDateEnd($date_end);

                $cv->addProfessionalExperience($professionalExperience);

                $userSession->setCv($cv);

                $entityManager->persist($userSession);
                $entityManager->persist($cv);
                $entityManager->flush();
                
                return $this->redirectToRoute('app_cv');

            }
        }

        



        return $this->render('cv/create.html.twig', [
            'skills' => $skills,
            'hobbies' => $hobbies,
            'languages' => $languages,
            'diplomas' => $diplomas,
        ]);
    }
}


// Première étape
// firstname : "Mika"
// lastname : "Aze"
// email : "aze@aze"
// phone : "0123456789"
// address : "1 rue de la paix"
// linkedin : "https://www"

// Deuxième étapes
// OneToMany : ProfessionnalExperiences

// Troisième étapes
// ManyToMany : Skill
// ManyToMany : Language
// ManyToMany : Hobby
