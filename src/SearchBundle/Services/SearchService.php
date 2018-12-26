<?php
/**
 * Created by PhpStorm.
 * User: juliengrima
 * Date: 19/01/2017
 * Time: 09:39
 */

namespace SearchBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;


class SearchService extends Controller
{
    protected $container;

    public function __construct(Container $container) {
        $this->container = $container;

    }

    public function getSearchPostTitre($requete){
//        Alias 'm' = AppBunble:Movies
//        Alias 'c' = category
//        Alias 'h' = header
//        Alias 'me' = media

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Movies');

        $qb = $repository->createQueryBuilder('m')
//            SELECT ALL FIELDS WE NEED
            ->select('m.actors, m.author, m.movies, m.resume, m.nationality, m.releaseDate, m.id, c.category')
//            JOIN ENTITIES
            ->join ('m.gallery', 'c')
//            TAKE INDICATIONS FOR FILEDS WITH REGEXP
            ->where('REGEXP(m.movies, :regexp) != false')
            ->orWhere('REGEXP(m.resume, :regexp)  != false')
            ->orWhere('REGEXP(m.author, :regexp)  != false')
            ->orWhere('REGEXP(m.actors, :regexp)  != false')
            ->orWhere('REGEXP(m.nationality, :regexp)  != false')
            ->orWhere('REGEXP(m.releaseDate, :regexp)  != false')
            ->orWhere('REGEXP(c.category, :regexp)  != false')
            ->setParameter('regexp', $requete)
            ->orderBy('m.movies');
        return $qb->getQuery()->getResult();
    }
}