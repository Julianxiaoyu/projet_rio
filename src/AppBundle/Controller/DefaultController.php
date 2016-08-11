<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Vote;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->redirectToRoute('user_login');
    }

    public function articleAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $epreuve = $em->getRepository('AppBundle:Epreuve')->findOneById($id);
        $participants = $em->getRepository('AppBundle:Participant')->findByIdepreuve($id);
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        $iduser = $user->getId();
        
        $uservote = $em->getRepository('AppBundle:Vote')->findBy(  
            array('iduser'=> $iduser, 'idepreuve'=> $id) // Critere
        );


        // Compter le nombre de vote

        foreach ($participants as $athlete){
            $firstname = $athlete->getFirstname();
            $lastname = $athlete->getLastname();

            $vote = $em->getRepository('AppBundle:Vote')->findByIdathlete($athlete->getId());
            $nbvote = count($vote);

            $liste_votes[]=array(
                    'firstname'=>$firstname,
                    'lastname'=>$lastname,
                    'nbvote'=>$nbvote,

                    );
        }

        return $this->render('default/article.html.twig', array(
                'epreuve'=>$epreuve,
                'participants'=>$participants,
                'liste_votes'=>$liste_votes,
                'uservote' =>$uservote,
                ));
    }

    public function voteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idparticipant = $request->request->get('idparticipant');
        $idepreuve = $request->request->get('idepreuve');

        $user = $this->container->get('security.context')->getToken()->getUser();
        $iduser = $user->getId();

        $hidden = $request->request->get('hidden');


        if ($hidden == 1){
            $vote = new Vote();
            $vote->setIduser($iduser);
            $vote->setIdathlete($idparticipant);
            $vote->setIdepreuve($idepreuve);

            $em->persist($vote);
            $em->flush();
        }

        // replace this example code with whatever you need
        $url = $this -> generateUrl('article', array( 'id'=>$idepreuve ));
        $response = new RedirectResponse($url);
        return $response;
    }

}
