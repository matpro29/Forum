<?php

namespace WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WebBundle\Form\Type\DelForm;
use Symfony\Component\HttpFoundation\Request;

class AllPostsController extends Controller
{
    public function allpostsAction(Request $request)
    {
        $form1 = $this->createForm(DelForm::class);
        $form1->handleRequest($request);

        if($form1->isSubmitted() && $form1->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $comment = $form1->getData();

            $comment = $em->getRepository('DatabaseBundle:Comment')->find($comment->getId());

            if( $comment )
            {
                $em->remove($comment);
                $em->flush();
            }
        }

        $comments = $this->getDoctrine()->getRepository('DatabaseBundle:Comment')->findAll();

        return $this->render('WebBundle:AllPosts:allposts.html.twig', array('form1' => $form1->createView(), 'comments' => $comments));
    }
}
