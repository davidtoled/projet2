<?php

namespace DI\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="DI\PlatformBundle\Repository\AdvertRepository")
 * @UniqueEntity(fields="title", message="Une annonce existe déjà avec ce titre")
 */
class Advert
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Length(min=10, minMessage="Le titre doit faire au moins {{ limit }} caractères.")
     *
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     * @Assert\Length(min=2, minMessage="Un auteur doit avoir au moins{{ limit }} caractères.")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
    * @ORM\OneToOne(targetEntity="DI\PlatformBundle\Entity\Image", cascade={"persist"})
    * @Assert\Valid()
    */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="DI\PlatformBundle\Entity\Category", cascade={"persist"})
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="DI\PlatformBundle\Entity\Application", mappedBy="advert")
     */
    private $applications;

    /**
     * @var
     * @ORM\Column(name="nb_applications", type="integer")
     *
     */
    private $nbApplications;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Advert
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
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Advert
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set image
     *
     * @param \DI\PlatformBundle\Entity\Image $image
     *
     * @return Advert
     */
    public function setImage(\DI\PlatformBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \DI\PlatformBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \Datetime();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->applications = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \DI\PlatformBundle\Entity\Category $category
     *
     * @return Advert
     */
    public function addCategory(\DI\PlatformBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \DI\PlatformBundle\Entity\Category $category
     */
    public function removeCategory(\DI\PlatformBundle\Entity\Category $category)
    {
        //$this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }


    /**
     * Add category
     *
     * @param \DI\PlatformBundle\Entity\Applicaions $application
     *
     * @return Advert
     */
    public function addApplication(\DI\PlatformBundle\Entity\Application $application)
    {
        $this->applications[] = $application;
        $application->setAdvert($this);

        return $this;
    }

    /**
     * Remove application
     *
     * @param \DI\PlatformBundle\Entity\Application $application
     */
    public function removeApplications(\DI\PlatformBundle\Entity\Application $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }

    public function increaseApplication() {
        $this->nbApplications++;
    }

    public function decreaseApplication() {
        $this->nbApplications--;
    }

    /**
     * @param mixed $nbApplications
     */
    public function setNbApplications($nbApplications)
    {
        $this->nbApplications = $nbApplications;
    }



    /**
     * @return mixed
     */
    public function getNbApplications()
    {
        return $this->nbApplications;
    }



}
