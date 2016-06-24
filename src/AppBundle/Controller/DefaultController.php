<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Issue;
use AppBundle\Entity\Task;
use AppBundle\Entity\Tweet;
use AppBundle\Entity\User;
use AppBundle\Form\Type\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $user = new User();
        $user->setUsername('shinework');
        $user->setEmail('badrien@jolicode.com');
        
        $address = new Address('18 avenue Parmentier', '75011', 'Paris', 'France');
        $user->setAddress($address);
        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/tweets", name="list_tweet")
     */
    public function listAction(Request $request)
    {
        $task = new Task();
        $issue = new Issue();
        $task->setTitle('coucou');
        $task->setIssue($issue);
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
        }

//        $tweets = $this->getDoctrine()->getManager()->getRepository(Tweet::class)->findAll();

        return $this->render('tweet/list.html.twig', [
//            'tweets' => $tweets,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/discount", name="discount")
     */
    public function discountAction()
    {
        $discountManager = $this->get('my_app.discount_manager');

        return $this->render('discount/show.html.twig');
    }
}
