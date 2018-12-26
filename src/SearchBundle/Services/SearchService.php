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
//        Alias 't' = AppBunble:Ticket
//        Alias 'c' = category
//        Alias 'h' = header
//        Alias 'me' = media

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Ticket');

        $qb = $repository->createQueryBuilder('t')
//            SELECT ALL FIELDS WE NEED
            ->select('t.user_name, t.society, t.phone, t.date, t.comment, t.email, t.id')
//            JOIN ENTITIES
//            TAKE INDICATIONS FOR FILEDS WITH REGEXP
            ->where('REGEXP(t.user_name, :regexp) != false')
            ->orWhere('REGEXP(t.society, :regexp)  != false')
            ->orWhere('REGEXP(t.phone, :regexp)  != false')
            ->orWhere('REGEXP(t.date, :regexp)  != false')
            ->orWhere('REGEXP(t.comment, :regexp)  != false')
            ->orWhere('REGEXP(t.email, :regexp)  != false')
            ->setParameter('regexp', $requete)
            ->orderBy('t.date');
        return $qb->getQuery()->getResult();
    }
}