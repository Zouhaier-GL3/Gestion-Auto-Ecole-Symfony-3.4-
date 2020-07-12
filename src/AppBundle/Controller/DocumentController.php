<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use AppBundle\Form\DocumentType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DocumentController extends Controller
{

    /**
     * @Route("/ajoutDocument", name="ajoutDocument")
     */
    public function ajoutDocumentAction(Request $request)
    {
        $Document = new Document();
        $form = $this->createForm(DocumentType::class,$Document);
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
                $Document->setFile($newFilename);
            }

            $em = $this->getDoctrine()->getManager();
            //$Document->upload();
            $em->persist($Document);
            $em->flush();
            return $this->redirect($this->generateUrl('listDocument'));
        }
        return $this->render("Document/AjoutDocument.html.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/listDocument", name="listDocument")
     */
    public function listDocumentAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $Document = $em->getRepository('AppBundle:Document')->findALL();

        return $this->render("Document/listDocument.html.twig",
            array('Document' => $Document));
    }

    /**
     * @Route("/supprimerD/{id}", name="supprimerD")
     */
    public function supprimerCAction(Request $request)
    {
        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $Document = $em->getRepository(Document::class)->find($id);

        if (!$Document) {
            throw $this->createNotFoundException('No Document found for id ');
        }

        $em->remove($Document);
        $em->flush();

        return $this->redirect($this->generateUrl('listDocument'));
    }

    /**
     * @Route("/listDocument2", name="listDocument2")
     */
    public function listDocument2Action()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $Document = $em->getRepository('AppBundle:Document')->findALL();

        return $this->render("Document/listDocument2.html.twig",
            array('Document' => $Document));
    }
}
