<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Post;
use AppBundle\Entity\Gif;
use AppBundle\Form\Type\PostType;
use AppBundle\Form\Type\GifType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //$form = $this->get('form.factory')->create(PostType::class);
        //$form->handleRequest($request);

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            //'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/upload/{id}", name="uploadGif")
     */
    public function uploadAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $gif = $em->getRepository(Gif::class)->find($id);
        
        $form = $this->get('form.factory')->create(GifType::class, $gif);
        $form->handleRequest($request);




        // replace this example code with whatever you need
        return $this->render('default/upload.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/{post_id}", name="view_post")
     * @ParamConverter("post", class="AppBundle:Post", options={"repository_method" = "findPostWithJoins", "mapping": {"post_id": "id"}})
     *
     */
    public function viewPostAction(Post $post)
    {

        dump($post);
        exit();
    }

}