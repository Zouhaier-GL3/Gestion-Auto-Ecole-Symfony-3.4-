<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Candidat;
use AppBundle\Form\CandidatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CandidatController extends Controller
{
    /**
     * @Route("/listCandidat", name="listCandidat")
     */
    public function listCandidatAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $Candidat = $em->getRepository('AppBundle:Candidat')->findALL();

        return $this->render("Candidat/listCandidat.html.twig",
            array('Candidat' => $Candidat));
    }
    /**
     * @Route("/ajoutCandidat", name="ajoutCandidat")
     */
    public function ajoutCandidatAction(Request $request)
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatType::class,$candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            /** @var UploadedFile $brochureFile */
            $brochureFile = $form['file']->getData();//dump($brochureFile, $form); die;

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('file_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $candidat->setFile($newFilename);
            }

            $em = $this->getDoctrine()->getManager();
            //$candidat->upload();
            $em->persist($candidat);
            $em->flush();
            return $this->redirect($this->generateUrl('listCandidat'));
        }
        return $this->render("Candidat/AjoutCandidat.html.twig",
            array('form' => $form->createView()));
    }
    /**
     * @Route("/modifierC/{id}", name="modifierC")
     */
    public function modifierCAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $candidat=$em->getRepository('AppBundle:Candidat')->find($id);

        $form = $this->createForm(CandidatType::class,$candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->persist($candidat);
            $em->flush();
            return $this->redirect($this->generateUrl('listCandidat'));
        }
        return $this->render("Candidat/AjoutCandidat.html.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/supprimerC/{id}", name="supprimerC")
     */
    public function supprimerCAction(Request $request)
    {
        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $candidat = $em->getRepository(Candidat::class)->find($id);

        if (!$candidat) {
            throw $this->createNotFoundException('No Candidat found for id ');
        }

        $em->remove($candidat);
        $em->flush();

        return $this->redirect($this->generateUrl('listCandidat'));
    }


    /**
     * @Route("/rechercheCandidat", name="rechercheCandidat")
     */
    public function recherchecandidatAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $Nom =$request->get('Nom');
        if($Nom){
            $candidat =$em->getRepository(Candidat::class)->findBy(array('Nom'=>$Nom));
        } else{
            $candidat = $em->getRepository(Candidat::class)->findAll();
        }

        return $this->render("Candidat/RechercheCandidat.html.twig",
            array('candidat'=>$candidat));
    }
}

