<?php

namespace WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DatabaseBundle\Entity\Comment;
use Symfony\Component\Validator\Constraints\DateTime;
use WebBundle\Form\Type\CommentForm;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends Controller
{
    public function imageAction($idImage,Request $request)
    {
        $form = $this->createForm(CommentForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $user = $this->container->get('security.token_storage')->getToken()->getUsername();
            $user = (string)$user;

            $date = new \DateTime();

            $comment = $form->getData();
            $comment->setIdImage($idImage);
            $comment->setUser($user);
            $comment->setDate($date);

            $em->persist($comment);
            $em->flush();
        }

        $comments = $this->getDoctrine()->getRepository('DatabaseBundle:Comment')->findBy(['idImage' => $idImage]);

        return $this->render('WebBundle:Image:image.html.twig', array('form' => $form->createView(),'idImage' => $idImage,'comments' => $comments));
    }
}
