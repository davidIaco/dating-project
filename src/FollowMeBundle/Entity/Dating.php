<?php

namespace FollowMeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dating
 *
 * @ORM\Table(name="dating", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Dating
{
    /**
     * @var string
     *
     * @ORM\Column(name="dating_title", type="string", length=64, nullable=false)
     */
    private $datingTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="dating_description", type="text", length=65535, nullable=false)
     */
    private $datingDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="dating_start", type="integer", nullable=false)
     */
    private $datingStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="dating_end", type="integer", nullable=false)
     */
    private $datingEnd;

    /**
     * @var float
     *
     * @ORM\Column(name="dating_lat", type="float", precision=10, scale=0, nullable=true)
     */
    private $datingLat;

    /**
     * @var float
     *
     * @ORM\Column(name="dating_lng", type="float", precision=10, scale=0, nullable=true)
     */
    private $datingLng;

    /**
     * @var string
     *
     * @ORM\Column(name="dating_link_href", type="string", length=128, nullable=true)
     */
    private $datingLinkHref;

    /**
     * @var string
     *
     * @ORM\Column(name="dating_link_title", type="string", length=64, nullable=true)
     */
    private $datingLinkTitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="dating_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $datingId;

    /**
     * @var \FollowMeBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="FollowMeBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;



    /**
     * Set datingTitle
     *
     * @param string $datingTitle
     *
     * @return Dating
     */
    public function setDatingTitle($datingTitle)
    {
        $this->datingTitle = $datingTitle;

        return $this;
    }

    /**
     * Get datingTitle
     *
     * @return string
     */
    public function getDatingTitle()
    {
        return $this->datingTitle;
    }

    /**
     * Set datingDescription
     *
     * @param string $datingDescription
     *
     * @return Dating
     */
    public function setDatingDescription($datingDescription)
    {
        $this->datingDescription = $datingDescription;

        return $this;
    }

    /**
     * Get datingDescription
     *
     * @return string
     */
    public function getDatingDescription()
    {
        return $this->datingDescription;
    }

    /**
     * Set datingStart
     *
     * @param integer $datingStart
     *
     * @return Dating
     */
    public function setDatingStart($datingStart)
    {
        $this->datingStart = $datingStart;

        return $this;
    }

    /**
     * Get datingStart
     *
     * @return integer
     */
    public function getDatingStart()
    {
        return $this->datingStart;
    }

    /**
     * Set datingEnd
     *
     * @param integer $datingEnd
     *
     * @return Dating
     */
    public function setDatingEnd($datingEnd)
    {
        $this->datingEnd = $datingEnd;

        return $this;
    }

    /**
     * Get datingEnd
     *
     * @return integer
     */
    public function getDatingEnd()
    {
        return $this->datingEnd;
    }

    /**
     * Set datingLat
     *
     * @param float $datingLat
     *
     * @return Dating
     */
    public function setDatingLat($datingLat)
    {
        $this->datingLat = $datingLat;

        return $this;
    }

    /**
     * Get datingLat
     *
     * @return float
     */
    public function getDatingLat()
    {
        return $this->datingLat;
    }

    /**
     * Set datingLng
     *
     * @param float $datingLng
     *
     * @return Dating
     */
    public function setDatingLng($datingLng)
    {
        $this->datingLng = $datingLng;

        return $this;
    }

    /**
     * Get datingLng
     *
     * @return float
     */
    public function getDatingLng()
    {
        return $this->datingLng;
    }

    /**
     * Set datingLinkHref
     *
     * @param string $datingLinkHref
     *
     * @return Dating
     */
    public function setDatingLinkHref($datingLinkHref)
    {
        $this->datingLinkHref = $datingLinkHref;

        return $this;
    }

    /**
     * Get datingLinkHref
     *
     * @return string
     */
    public function getDatingLinkHref()
    {
        return $this->datingLinkHref;
    }

    /**
     * Set datingLinkTitle
     *
     * @param string $datingLinkTitle
     *
     * @return Dating
     */
    public function setDatingLinkTitle($datingLinkTitle)
    {
        $this->datingLinkTitle = $datingLinkTitle;

        return $this;
    }

    /**
     * Get datingLinkTitle
     *
     * @return string
     */
    public function getDatingLinkTitle()
    {
        return $this->datingLinkTitle;
    }

    /**
     * Get datingId
     *
     * @return integer
     */
    public function getDatingId()
    {
        return $this->datingId;
    }

    /**
     * Set user
     *
     * @param \FollowMeBundle\Entity\User $user
     *
     * @return Dating
     */
    public function setUser(\FollowMeBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \FollowMeBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
