<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:48 PM
 * Last Modified: 11/10/21, 6:52 PM
 * Project Name: aqarmap-blog-task
 * File Name: Comment.php
 */

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="comment", type="string", length=500, nullable=false)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="comments")
     * @ORM\JoinTable(
     *     name="Article_Comments",
     *     joinColumns={@ORM\JoinColumn(name="article-id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $article;

    /**
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=false)
     */
    private $addedAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setAddedAt($date)
    {
        if ($date) {
            $this->addedAt = $date;
        } else {
            $this->addedAt = new \DateTime("now");
        }
    }

    /**
     * @return Article|null
     */
    public function getArticle(): ?Article
    {
        return $this->article;
    }

    /**
     * @param Article $article
     * @return Comment
     */
    public function setArticle(Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
