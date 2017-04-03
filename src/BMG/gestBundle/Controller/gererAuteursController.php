<?php

namespace BMG\gestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BMG\gestBundle\Form\AuteurType;
//Ajouter l'entité Auteur
use BMG\gestBundle\Entity\Auteur;

class gererAuteursController extends Controller
{
    public function indexAction(){
        try{
            $em = $this->getDoctrine()->getManager();
            $repository_auteur = $em->getRepository('BMGgestBundle:Auteur');
            $listeAuteurs = $repository_auteur->findAll();
            
            // appeler la vue pour mes afficher en passant cet objet en paramètre
            return $this->render('BMGgestBundle:auteur:listeAuteurs.html.twig', array('lesAuteurs' => $listeAuteurs,));
        }
        catch (\Exeption $e){
            $this->addFlash('error', "Erreur dans l'affichage des auteurs.");
            //redirection vers l'accueil
            return $this->render('BMGgestBundle:Default:index.html.twig');
        }
    }
    
    public function consulterAction($id){
        $hasError = false;
        if($id != "000"){
            // récupérer l'objet Auteur correspondant à $id
            $em = $this->getDoctrine()->getManager();
            $repository_auteur = $em->getRepository('BMGgestBundle:Auteur');
            $leAuteur = $repository_auteur->find($id);
            if ($leAuteur === NULL){
                //flash message
                $this->addFlash('error', "Ce auteur n'existe pas !");
                $hasError = true;
            }
        }
        else{
            $this->addFlash('error', "Aucun auteur n'a été transmis pour la consultation !");
            $hasError = true;
        }
        if($hasError){
            return $this->redirectToRoute('bmg_lister_auteurs');
        }
        else{
            return $this->render('BMGgestBundle:auteur:consulterAuteur.html.twig', array('leAuteur' => $leAuteur,));
        }
    }
    
    public function ajouterAction(Request $request){
        $auteur = new Auteur();
        $form = $this->get('form.factory')->create(AuteurType::class, $auteur);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            try{
                $em = $this->getDoctrine()->getManager();
                $em->persist($auteur);
                $em->flush();
                
                $this->addFlash('notice', "L'auteur ".$auteur->getIdAuteur()."-".$auteur->getPrenomAuteur()." ".$auteur->getNomAuteur()." a bien été ajouté.");
                return $this->render('BMGgestBundle:auteur:consulterAuteur.html.twig', array('leAuteur' => $auteur,));
            }
            catch(\Exception $e){
                $this->addFlash('error', "Erreur dans l'ajout !");
                return $this->render('BMGgestBundle:auteur:ajouterAuteur.html.twig', array('form' => $form->createView(),));
            }
        }
        else{
            return $this->render('BMGgestBundle:auteur:ajouterAuteur.html.twig', array('form' => $form->createView(),));
        }
    }
    
    public function modifierAction($id, Request $request){
        if($id != "000"){
            $em = $this->getDoctrine()->getManager();
            $repository_auteur = $em->getRepository('BMGgestBundle:Auteur');
            $leAuteur = $repository_auteur->find($id);
            if($leAuteur == NULL){
                $this->addFlash('error', "Modification impossible : l'auteur ".$id." n'existe pas");
                return $this-redirectionToRoute('bmg_lister_auteurs');
            }
            else{
                $form = $this->get('form.factory')->create(AuteurType::class, $leAuteur);
                if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
                    try{
                        $em->flush();
                        $this->addFlash('notice',"L'auteur ".$id."-".$leAuteur->getPrenomAuteur()." ".$leAuteur->getNomAuteur()."a été modifié !");
                        return $this->render('BMGgestBundle:auteur:consulterAuteur.html.twig', array('leAuteur' => $leAuteur,));
                    }
                    catch(Exception $ex){
                        $this->addFlash('error', "Erreur dans la modification !");
                        return $this->render('BMGgestBundle:auteur:modificationAuteur.html.twig', array('form' => $form->createView(), 'leAuteur' => $leAuteur,));
                    }
                }
                else{
                    return $this->render('BMGgestBundle:auteur:modifierAuteur.html.twig', array('form' => $form->createView(), 'leAuteur' => $leAuteur,));
                }
            }
        }
        else{
            $this->addFlash('error', "Modifcation impossible : pas d'auteur à modifier !");
            return $this->redirectToRoute('bmg_lister_auteurs');
        }
        
    }
    
    public function supprimerAction($id){
        if($id != "000"){
            $em = $this->getDoctrine()->getManager();
            $repository_auteur = $em->getRepository('BMGgestBundle:Auteur');
            $leAuteur = $repository_auteur->find($id);
            if ($leAuteur === NULL){
                //flash message
                $this->addFlash('error', "Cet auteur n'existe pas !");
                $hasError = true;
            }
            else{
                if(count($leAuteur->getOuvrages()) == 0){
                    $em->remove($leAuteur);
                    $em->flush();

                    $this->addFlash('notice', "L'auteur ".$id."-".$leAuteur->getPrenomAuteur()." ".$leAuteur->getNomAuteur()." a été supprimé !");
                    return $this->redirectToRoute('bmg_lister_auteurs');
                }
                else{
                    $this->addFlash('error', "L'auteur ".$id." est référencé par les ouvrages, suppression impossible !");
                    $hasError = true;
                }
            }
        }
        else{
            $this->addFlash('error', "Suppression impossible il n'y a pas d'auteur !");
            $hasError = true;
        }
        if($hasError){
            return $this->redirectToRoute('bmg_lister_auteurs');
        }
    }
}
