<?php

namespace AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;


    public function __construct()
    {
        parent::__construct ();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ticket;


    /**
     * Add ticket.
     *
     * @param \AppBundle\Entity\Ticket $ticket
     *
     * @return User
     */
    public function addTicket(\AppBundle\Entity\Ticket $ticket)
    {
        $this->ticket[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket.
     *
     * @param \AppBundle\Entity\Ticket $ticket
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTicket(\AppBundle\Entity\Ticket $ticket)
    {
        return $this->ticket->removeElement($ticket);
    }

    /**
     * Get ticket.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
