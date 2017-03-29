<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UploadForm;
use AppBundle\Entity\Images;


class Upload extends Controller
{
    /**
     * @Route("/upload/")
     */
    public function numberAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $imageEntity = new Images();
        $form = $this->createForm(UploadForm::class, $imageEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $imageEntity->setImageFile($form->get('imageFile')->getData());
            $em->persist($imageEntity);
            $em->flush();
        }

        return $this->render('upload.html.twig', array(
           'form' => $form->createView()
        ));

    }

}
