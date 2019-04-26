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

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Ticket');

        $qb = $repository->createQueryBuilder('t')
//            SELECT ALL FIELDS WE NEED
            ->select('t.society, t.phone, t.date, t.comment, t.id, t.treated, t.user_id')
//            JOIN ENTITIES
//            TAKE INDICATIONS FOR FILEDS WITH REGEXP
            ->Where('REGEXP(t.society, :regexp)  != false')
            ->orWhere('REGEXP(t.phone, :regexp)  != false')
            ->orWhere('REGEXP(t.date, :regexp)  != false')
            ->orWhere('REGEXP(t.comment, :regexp)  != false')
            ->setParameter('regexp', $requete)
            ->orderBy('t.date');

        return $qb->getQuery()->getResult();
    }

    public function getSearchPostAdmin($requete){
//        Alias 'u' = AdminBundle:User

        $repository = $this->getDoctrine()
            ->getRepository('AdminBundle:User');

        $qb = $repository->createQueryBuilder('u')
//            SELECT ALL FIELDS WE NEED
            ->select('u.id, u.username, u.email')
//            JOIN ENTITIES
//            TAKE INDICATIONS FOR FILEDS WITH REGEXP
            ->Where('REGEXP(u.username, :regexp)  != false')
            ->orWhere('REGEXP(u.email, :regexp)  != false')
            ->setParameter('regexp', $requete)
            ->orderBy('u.username');

        return $qb->getQuery()->getResult();
    }
}