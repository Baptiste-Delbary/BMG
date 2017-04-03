<?php

namespace BMG\gestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BMG\gestBundle\Form\GenreType;
use BMG\gestBundle\Form\GenreEditType;
//Ajouter l'entité Genre
use BMG\gestBundle\Entity\Genre;

class gererGenresController extends Controller
{
    public function indexAction(){
        try{
            $em = $this->getDoctrine()->getManager();
            $repository_genre = $em->getRepository('BMGgestBundle:Genre');
            $listeGenres = $repository_genre->findAll();
            
            // appeler la vue pour mes afficher en passant cet objet en paramètre
            return $this->render('BMGgestBundle:genre:listeGenres.html.twig', array('lesGenres' => $listeGenres,));
        }
        catch (\Exception $e){
            $this->addFlash(
                    'error',
                    'Erreur dans l\'affichage des genres.'
            );
            //redirection vers l'accueil
            return $this->render('BMGgestBundle:Default:index.html.twig');
        }
    }
    
    public function consulterAction($id){
        $hasError = false;
        if($id != "000"){
            // récupérer l'objet Genre correspondant à $id
            $em = $this->getDoctrine()->getManager();
            $repository_genre = $em->getRepository('BMGgestBundle:Genre');
            $leGenre = $repository_genre->find($id);
            if ($leGenre === NULL){
                //flash message
                $this->addFlash('error', "Ce genre n'existe pas !");
                $hasError = true;
            }
        }
        else{
            $this->addFlash('error', "Aucun genre n'a été transmis pour la consultation !");
            $hasError = true;
        }
        if($hasError){
            return $this->redirectToRoute('bmg_lister_genres');
        }
        else{
            return $this->render('BMGgestBundle:genre:consulterGenre.html.twig', array('leGenre' => $leGenre,));
        }
    }
    
    public function ajouterAction(Request $request){
        $genre = new Genre();
        $form = $this->get('form.factory')->create(GenreType::class, $genre);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            try{
                $genre->setCodeGenre(strtoupper($genre->getCodeGenre()));
                $em = $this->getDoctrine()->getManager();
                $em->persist($genre);
                $em->flush();
                
                $this->addFlash('notice', "Le genre ".$genre->getCodeGenre()."-".$genre->getLibGenre()." a bien été ajouté.");
                return $this->render('BMGgestBundle:genre:consulterGenre.html.twig', array('leGenre' => $genre,));
            }
            catch(\Exception $e){
                $this->addFlash('error', "Erreur dans l'ajout, il existe déjà un genre avec ce code !");
                return $this->render('BMGgestBundle:genre:ajouterGenre.html.twig', array('form' => $form->createView(),));
            }
        }
        else{
            return $this->render('BMGgestBundle:genre:ajouterGenre.html.twig', array('form' => $form->createView(),));
        }
    }
    
    public function modifierAction($id, Request $request){
        if($id != "000"){
            $id = strtoupper($id);
            $em = $this->getDoctrine()->getManager();
            $repository_genre = $em->getRepository('BMGgestBundle:Genre');
            $leGenre = $repository_genre->find($id);
            if($leGenre == NULL){
                $this->addFlash('error', "Modification impossible : le genre ".$id." n'existe pas");
                return $this-redirectionToRoute('bmg_lister_genres');
            }
            else{
                $form = $this->get('form.factory')->create(GenreEditType::class, $leGenre);
                if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
                    try{
                        $em->flush();
                        $this->addFlash('notice',"Le genre ".$id."-".$leGenre->getLibGenre()." a été modifié !");
                        return $this->render('BMGgestBundle:genre:consulterGenre.html.twig', array('leGenre' => $leGenre,));
                    }
                    catch(Exception $ex){
                        $this->addFlash('error', "Erreur dans la modification !");
                        return $this->render('BMGgestBundle:genre:modifierGenre.html.twig', array('form' => $form->createView(), 'leGenre' => $leGenre,));
                    }
                }
                else{
                    return $this->render('BMGgestBundle:genre:modifierGenre.html.twig', array('form' => $form->createView(), 'leGenre' => $leGenre,));
                }
            }
        }
        else{
            $this->addFlash('error', "Modifcation impossible : pas de genre à modifier !");
            return $this->redirectToRoute('bmg_lister_genres');
        }
        
    }
    
    public function supprimerAction($id){
        if($id != "000"){ // Si c'est en parametre
            $em = $this->getDoctrine()->getManager();
            $repository_genre = $em->getRepository('BMGgestBundle:Genre');
            $leGenre = $repository_genre->find($id);
            if ($leGenre === NULL){
                //flash message
                $this->addFlash('error', "Ce genre n'existe pas !");
                $hasError = true;
            }
            else{
                $repository_ouvrage = $em->getRepository('BMGgestBundle:Ouvrage');
                $ouvragesDuGenre = $repository_ouvrage->findByGenre($id);
                if($ouvragesDuGenre == NULL){
                    $em->remove($leGenre);
                    $em->flush();

                    $this->addFlash('notice', "Le genre ".$id."-".$leGenre->getLibGenre()." a été supprimé !");
                    return $this->redirectToRoute('bmg_lister_genres');
                }
                else{
                    $this->addFlash('error', "Le genre ".$id." est référencé par les ouvrages, suppression impossible !");
                    $hasError = true;
                }
            }
        }
        else{
            $this->addFlash('error', "Suppression impossible il n'y a pas de genre !");
            $hasError = true;
        }
        if($hasError){
            return $this->redirectToRoute('bmg_lister_genres');
        }
    }
}
