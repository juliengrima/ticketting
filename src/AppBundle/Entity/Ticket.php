<?php

namespace AppBundle\Entity;

/**
 * Ticket
 */
class Ticket
{
    public function __construct()
    {
//        Give date for ticket
        $this->date = new \DateTime('now');

//        take ip address of the computer who make the ticket
        $interfaces = ['wlan', 'eth', 'en'];
        $found = 0;
        $interfaces_text = '';
        $interfaces_text_short = '';

        foreach ($interfaces as $interface) {

            for ($i = 0;$i < 5;++$i) {

                $command = '/sbin/ifconfig '.$interface.$i." | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}'";
                $localIP = exec($command);

                if ($localIP != '') {

                    $interfaces_text .= '('.$interface.$i.')'.$localIP;
                    $interfaces_text_short .= '('.$interface.$i.') '.$localIP;
                    ++$found;

                } else {

                    $command = '/sbin/ifconfig '.$interface.$i." | grep 'inet' | cut -d: -f2 | awk '{ print $2}'";
                    $localIP = exec($command);

                    if ($localIP != '') {

                        $interfaces_text .= '('.$interface.$i.')'.$localIP;
                        $interfaces_text_short .= '('.$interface.$i.') '.$localIP;
                        ++$found;

                    }
                }
            }
        }

        $this->ip_address = $interfaces_text;

    }

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $society;

    /**
     * @var integer
     */
    private $phone;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var bool|null
     */
    private $treated;

    /**
     * @var string
     */
    private $ip_address;

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
     * Set society
     *
     * @param string $society
     *
     * @return Ticket
     */
    public function setSociety($society)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return string
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return Ticket
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Ticket
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Ticket
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set treated.
     *
     * @param bool|null $treated
     *
     * @return Ticket
     */
    public function setTreated($treated = null)
    {
        $this->treated = $treated;

        return $this;
    }

    /**
     * Get treated.
     *
     * @return bool|null
     */
    public function getTreated()
    {
        return $this->treated;
    }

    /**
     * Set ipAddress.
     *
     * @param string $ipAddress
     *
     * @return Ticket
     */
    public function setIpAddress($ipAddress)
    {
        $this->ip_address = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress.
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

//    MAPPED BY USER

    /**
     * @var \AdminBundle\Entity\User
     */
    private $user;


    /**
     * Set user.
     *
     * @param \AdminBundle\Entity\User|null $user
     *
     * @return Ticket
     */
    public function setUser(\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AdminBundle\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
