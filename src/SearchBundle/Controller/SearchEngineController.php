<?php
/**
 * Created by PhpStorm.
 * User: juliengrima
 * Date: 04/01/2017
 * Time: 16:33
 */

namespace SearchBundle\Controller;

use Search\SearchBundle;
use Search\Services\SearchService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class SearchEngineController extends Controller
{
    // SEARCH BY WORDS
    public function searchAction(Request $request)
    {
        // TESTING IF _POST EXIST AND NOT EMPTY
        if(isset($_POST['requete']) && $_POST['requete'] != NULL) {

            // USING htmlspecialchars() function
            $requete_str = htmlspecialchars($_POST['requete']);
            $requete = strtolower($requete_str);

            // CALLING SERVICE
            $champTitre = $this->container->get('search.service')->getSearchPostTitre ($requete);

            // champTitre RETURN NOTHING
            if (empty($champTitre)) {

                $this->addFlash (
                    'success',
                    '!!! Le mot recherché n\'a pas été trouvé !!!'
                );

                return $this->render ('@Search/Default/index.html.twig', array (
                    'resultats' => '',
                ));

            }
            // IF RETURN SOMETHING
            else {

                // maintenant, on va afficher la page qui va afficher les résultats
                return $this->render ('@Search/Default/index.html.twig', array (
                    'resultats' => $champTitre,
                ));
            }
        }
        // IF EMPTY
        else {

            $this->addFlash (
                'success',
                '!!! Attention, n\'oubliez pas d\écrire un mot !!!'
            );

            return $this->render ('@Search/Default/index.html.twig', array (
                'resultats' => '',
            ));

        }
    }

}