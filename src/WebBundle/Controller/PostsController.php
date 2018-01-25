<?php

namespace WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WebBundle\Form\Type\DelForm;
use WebBundle\Form\Type\UpdForm;
use Symfony\Component\HttpFoundation\Request;

class PostsController extends Controller
{
    public function postsAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUsername();
        $user = (string)$user;

        $form1 = $this->createForm(DelForm::class);
        $form1->handleRequest($request);

        if($form1->isSubmitted() && $form1->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $comment = $form1->getData();

            $comment = $em->getRepository('DatabaseBundle:Comment')->find($comment->getId());

            if( $comment ) {
                if ($comment->getUser() == $user) {
                    $em->remove($comment);
                    $em->flush();
                }
            }
        }

        $form2 = $this->createForm(UpdForm::class);
        $form2->handleRequest($request);

        if($form2->isSubmitted() && $form2->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $form2Data = $form2->getData();

            $comment = $em->getRepository('DatabaseBundle:Comment')->find($form2Data->getId());

            if( $comment ) {
                if ($comment->getUser() == $user) {
                    $date = new \DateTime();

                    $comment->setComment($form2Data->getComment());
                    $comment->setDate($date);

                    $em->flush();
                }
            }
        }

        $comments = $this->getDoctrine()->getRepository('DatabaseBundle:Comment')->findBy(['user' => $user]);

        return $this->render('WebBundle:Posts:posts.html.twig', array('form1' => $form1->createView(), 'form2' => $form2->createView(),'comments' => $comments));
    }
}
