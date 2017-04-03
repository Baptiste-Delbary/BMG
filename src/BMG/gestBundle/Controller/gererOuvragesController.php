<?php

namespace BMG\gestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BMG\gestBundle\Form\OuvrageType;
use BMG\gestBundle\Form\AuteurOuvrageAddType;
//Ajouter l'entité Ouvrage
use BMG\gestBundle\Entity\Ouvrage;

class gererOuvragesController extends Controller
{
    public function indexAction(){
        try{
            $em = $this->getDoctrine()->getManager();
            $repository_ouvrage = $em->getRepository('BMGgestBundle:Ouvrage');
            $listeOuvrages = $repository_ouvrage->findAll();

            
            
            // appeler la vue pour mes afficher en passant cet objet en paramètre
            return $this->render('BMGgestBundle:ouvrage:listeOuvrages.html.twig', array('lesOuvrages' => $listeOuvrages,));
        }
        catch (\Exception $e){
            $this->addFlash(
                    'error',
                    "Erreur dans l'affichage des ouvrages."
            );
            //redirection vers l'accueil
            return $this->render('BMGgestBundle:Default:index.html.twig');
        }
    }

    public function consulterAction($id){
        $hasError = false;
        if($id != "000"){
            // récupérer l'objet Ouvrage correspondant à $id
            $em = $this->getDoctrine()->getManager();
            $repository_ouvrage = $em->getRepository('BMGgestBundle:Ouvrage');
            $leOuvrage = $repository_ouvrage->find($id);
            if ($leOuvrage === NULL){
                //flash message
                $this->addFlash('error', "Cet ouvrage n'existe pas !");
                $hasError = true;
            }
            else{
                $repository_pret = $em->getRepository('BMGgestBundle:Pret');
                $lePret = $repository_pret->findOneByOuvrage($id, array('dateEmp' => 'DESC'));
            }
        }
        else{
            $this->addFlash('error', "Aucun ouvrage n'a été transmis pour la consultation !");
            $hasError = true;
        }
        if($hasError){
            return $this->redirectToRoute('bmg_lister_ouvrages');
        }
        else{
            return $this->render('BMGgestBundle:ouvrage:consulterOuvrage.html.twig', array('leOuvrage' => $leOuvrage, 'lePret' => $lePret,));
        }
    }

    public function ajouterAction(Request $request){
        $ouvrage = new Ouvrage();
        $form = $this->get('form.factory')->create(OuvrageType::class, $ouvrage);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            if(preg_match("/^[A-Z][0-9]$/", strtoupper($ouvrage->getRayon()))){
                try{
                    $ouvrage->setRayon(strtoupper($ouvrage->getRayon()));
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($ouvrage);
                    $em->flush();
                    
                    $this->addFlash('notice', "L'ouvrage ".$ouvrage->getNoOuvrage()."-".$ouvrage->getTitre()." a bien été ajouté.");
                    return $this->render('BMGgestBundle:ouvrage:consulterOuvrage.html.twig', array('leOuvrage' => $ouvrage, 'lePret' => NULL));
                }
                catch(\Exception $e){
                    $this->addFlash('error', "Erreur dans l'ajout !");
                    return $this->render('BMGgestBundle:ouvrage:ajouterOuvrage.html.twig', array('form' => $form->createView(),));
                }
            }
            else{
                $this->addFlash('error', "Le rayon doit se composer d'une lettre puis d'un chiffre !");
                return $this->render('BMGgestBundle:ouvrage:ajouterOuvrage.html.twig', array('form' => $form->createView(),));
            }
        }
        else{
            return $this->render('BMGgestBundle:ouvrage:ajouterOuvrage.html.twig', array('form' => $form->createView(),));
        }
    }

    public function modifierAction($id, Request $request){
        if($id != "000"){
            $em = $this->getDoctrine()->getManager();
            $repository_ouvrage = $em->getRepository('BMGgestBundle:Ouvrage');
            $leOuvrage = $repository_ouvrage->find($id);
            if($leOuvrage === NULL){
                $this->addFlash('error', "Modification impossible : l'ouvrage ".$id." n'existe pas");
                return $this-redirectionToRoute('bmg_lister_ouvrages');
            }
            else{
                $form = $this->get('form.factory')->create(OuvrageType::class, $leOuvrage);
                if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
                    if(preg_match("/^[A-Z][0-9]$/", strtoupper($leOuvrage->getRayon()))){
                        try{
                            $leOuvrage->setRayon(strtoupper($leOuvrage->getRayon()));
                            $em->flush();
                            $this->addFlash('notice',"L'ouvrage ".$id."-".$leOuvrage->getTitre()." a été modifié !");

                            $repository_pret = $em->getRepository('BMGgestBundle:Pret');
                            $lePret = $repository_pret->findOneByOuvrage($id, array('dateEmp' => 'DESC'));

                            return $this->render('BMGgestBundle:ouvrage:consulterOuvrage.html.twig', array('leOuvrage' => $leOuvrage, 'lePret' => $lePret));
                        }
                        catch(Exception $ex){
                            $this->addFlash('error', "Erreur dans la modification !");
                            return $this->render('BMGgestBundle:ouvrage:modifierOuvrage.html.twig', array('form' => $form->createView(),  'leOuvrage' => $leOuvrage,));
                        }
                    }
                    else{
                        $this->addFlash('error', "Le rayon doit se composer d'une lettre puis d'un chiffre !");
                        return $this->render('BMGgestBundle:ouvrage:modifierOuvrage.html.twig', array('form' => $form->createView(),  'leOuvrage' => $leOuvrage,));
                    }
                }
                else{
                    return $this->render('BMGgestBundle:ouvrage:modifierOuvrage.html.twig', array('form' => $form->createView(),  'leOuvrage' => $leOuvrage,));
                }
            }
        }
        else{
            $this->addFlash('error', "Modifcation impossible : pas d'ouvrage à modifier !");
            return $this->redirectToRoute('bmg_lister_ouvrages');
        }
        
    }

    public function supprimerAction($id){
        if($id != "000"){ // Si c'est en parametre
            $em = $this->getDoctrine()->getManager();
            $repository_ouvrage = $em->getRepository('BMGgestBundle:Ouvrage');
            $leOuvrage = $repository_ouvrage->find($id);
            if ($leOuvrage === NULL){
                //flash message
                $this->addFlash('error', "Cet ouvrage n'existe pas !");
                $hasError = true;
            }
            else{
                $auteursOuvrage = $leOuvrage->getAuteurs();
                if(count($auteursOuvrage) > 0){
                    foreach ($auteursOuvrage as $unAuteur) {
                        $leOuvrage->removeAuteur($unAuteur);
                    }
                }
                $em->remove($leOuvrage);
                $em->flush();

                $this->addFlash('notice', "L'ouvrage ".$id."-".$leOuvrage->getTitre()." a été supprimé !");
                return $this->redirectToRoute('bmg_lister_ouvrages');
            }
        }
        else{
            $this->addFlash('error', "Suppression impossible il n'y a pas d'ouvrage !");
            $hasError = true;
        }
        if($hasError){
            return $this->redirectToRoute('bmg_lister_ouvrages');
        }
    }

    public function listerauteursouvrageAction($id){
        if($id != "000"){
            $em = $this->getDoctrine()->getManager();
            $repository_ouvrage = $em->getRepository('BMGgestBundle:Ouvrage');
            $leOuvrage = $repository_ouvrage->find($id);
            if($leOuvrage === NULL){
                $this->addFlash('error', "Suppression impossible : l'ouvrage ".$id." n'existe pas");
                $hasError = true;
            }
            else{
                try{
                    $lesAuteurs = $leOuvrage->getAuteurs();
                    if(count($lesAuteurs) > 0){
                        return $this->render('BMGgestBundle:ouvrage:listeAuteursOuvrage.html.twig', array('leOuvrage' => $leOuvrage, 'lesAuteurs' => $lesAuteurs,));
                    }
                    else{
                        $this->addFlash('error', "Il n'y a aucun auteur pour cette ouvrage");
                        $hasError = true;
                    }
                }
                catch(\Exception $e){
                    $this->addFlash('error', "Erreur dans l'affichage des auteurs");
                    $hasError = true;
                }
            }
        }
        else{
            $this->addFlash('error', "Aucun ouvrage transmis");
            $hasError = true;
        }
        if($hasError){
            $repository_pret = $em->getRepository('BMGgestBundle:Pret');
            $lePret = $repository_pret->findOneByOuvrage($id, array('dateEmp' => 'DESC'));

            return $this->render('BMGgestBundle:ouvrage:consulterOuvrage.html.twig', array('leOuvrage' => $leOuvrage, 'lePret' => $lePret));
        }
    }

    public function ajouterauteurAction($id, Request $request){
        $hasError = false;
        if($id != "000"){
            // récupérer l'objet Ouvrage correspondant à $id
            $em = $this->getDoctrine()->getManager();
            $repository_ouvrage = $em->getRepository('BMGgestBundle:Ouvrage');
            $ouvrage = $repository_ouvrage->find($id);
            if ($ouvrage === NULL){
                //flash message
                $this->addFlash('error', "Cet ouvrage n'existe pas !");
                $hasError = true;
            }
            else{
                $repository_pret = $em->getRepository('BMGgestBundle:Pret');
                $lePret = $repository_pret->findOneByOuvrage($id, array('dateEmp' => 'DESC'));

                $form = $this->get('form.factory')->create(AuteurOuvrageAddType::class, $ouvrage);
                if($request->isMethod('POST')){
                     try{
                        $data = $form['auteurs']->getData();
                        $ouvrage->addAuteur($data);
                        $em->persist($ouvrage);
                        $em->flush();
                        
                        $this->addFlash('notice', "L'auteur ".$leAuteur->getNomAuteur()." a bien été ajouté à l'ouvrage ".$ouvrage->getTitre());
                        return $this->render('BMGgestBundle:ouvrage:consulterOuvrage.html.twig', array('leOuvrage' => $ouvrage, 'lePret' => $lePret,));
                    }
                    catch(\Exception $e){
                        $this->addFlash('error', "Erreur dans l'ajout !");
                        return $this->render('BMGgestBundle:ouvrage:ajouterAuteurOuvrage.html.twig', array('form' => $form->createView(), 'leOuvrage' => $ouvrage,));
                    }
                }
            }
        }
        else{
            $this->addFlash('error', "Aucun ouvrage n'a été transmis pour la consultation !");
            $hasError = true;
        }
        if($hasError){
            return $this->render('BMGgestBundle:ouvrage:consulterOuvrage.html.twig', array('leOuvrage' => $leOuvrage, 'lePret' => $lePret,));
        }
        else{
            return $this->render('BMGgestBundle:ouvrage:ajouterAuteurOuvrage.html.twig', array('form' => $form->createView(), 'leOuvrage' => $ouvrage,));
        }
    }

    public function supprimerauteurAction ($idOuvrage, $idAuteur){
        $hasError = false;
        if($idOuvrage != "000"){
            $em = $this->getDoctrine()->getManager();
            $repository_ouvrage = $em->getRepository('BMGgestBundle:Ouvrage');
            $leOuvrage = $repository_ouvrage->find($idOuvrage);
            if($leOuvrage === NULL){
                $this->addFlash('error', "Suppression impossible : l'ouvrage ".$idOuvrage." n'existe pas");
                $hasError = true;
            }
            else{
                if($idAuteur !== "000"){
                    $repository_auteur = $em->getRepository('BMGgestBundle:Auteur');
                    $leAuteur = $repository_auteur->find($idAuteur);
                    if($leAuteur === NULL){
                        $this->addFlash('error', "Suppression : l'auteur ".$idAuteur." n'existe pas");
                        $hasError = true;
                    }
                    else{
                        try{
                            $leOuvrage->removeAuteur($leAuteur);
                            $em->flush();
                            $repository_pret = $em->getRepository('BMGgestBundle:Pret');
                            $lePret = $repository_pret->findOneByOuvrage($idOuvrage, array('dateEmp' => 'DESC'));
                            $this->addFlash('notice', "L'auteur à été supprimé !");
                            return $this->render('BMGgestBundle:ouvrage:consulterOuvrage.html.twig', array('leOuvrage' => $leOuvrage, 'lePret' => $lePret,));
                        }
                        catch(\Exception $e){
                            $this->addFlash('error', "Erreur dans la modification !");
                            $hasError = true;
                        }
                    }
                }
                else{
                    $this->addFlash('error', "Aucun auteur n'a été transmis !");
                    $hasError = true;
                }
            }
        }
        else{
            $this->addFlash('error', "Aucun ouvrage n'a été transmis !");
            $hasError = true;
        }
        if($hasError){
            $lesAuteurs = $leOuvrage->getAuteurs();
            return $this->render('BMGgestBundle:ouvrage:listeAuteursOuvrage.html.twig', array('leOuvrage' => $leOuvrage, 'lesAuteurs' => $lesAuteurs,));
        }
    }
}
