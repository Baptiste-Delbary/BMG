<?php

namespace BMG\gestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Template ("BMGgestBundle:Default:index.html.twig")
     * @Route ("/")
     */
    public function indexAction()
    {
        $session = $this->get('session');
        $session->set('id', 9999);
        $session->set('nom','Dupont');
        $session->set('prenom', 'Jean');
    }
}
