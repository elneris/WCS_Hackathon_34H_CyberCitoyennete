<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $goodAnswer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $wrongAnswerOne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $wrongAnswerTwo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $wrongAnswerThree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tentative", mappedBy="question", orphanRemoval=true)
     */
    private $tentative;

    public function __construct()
    {
        $this->tentative = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getGoodAnswer(): ?string
    {
        return $this->goodAnswer;
    }

    public function setGoodAnswer(string $goodAnswer): self
    {
        $this->goodAnswer = $goodAnswer;

        return $this;
    }

    public function getWrongAnswerOne(): ?string
    {
        return $this->wrongAnswerOne;
    }

    public function setWrongAnswerOne(string $wrongAnswerOne): self
    {
        $this->wrongAnswerOne = $wrongAnswerOne;

        return $this;
    }

    public function getWrongAnswerTwo(): ?string
    {
        return $this->wrongAnswerTwo;
    }

    public function setWrongAnswerTwo(string $wrongAnswerTwo): self
    {
        $this->wrongAnswerTwo = $wrongAnswerTwo;

        return $this;
    }

    public function getWrongAnswerThree(): ?string
    {
        return $this->wrongAnswerThree;
    }

    public function setWrongAnswerThree(string $wrongAnswerThree): self
    {
        $this->wrongAnswerThree = $wrongAnswerThree;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Tentative[]
     */
    public function getTentative(): Collection
    {
        return $this->tentative;
    }

    public function addTentative(Tentative $tentative): self
    {
        if (!$this->tentative->contains($tentative)) {
            $this->tentative[] = $tentative;
            $tentative->setQuestion($this);
        }

        return $this;
    }

    public function removeTentative(Tentative $tentative): self
    {
        if ($this->tentative->contains($tentative)) {
            $this->tentative->removeElement($tentative);
            // set the owning side to null (unless already changed)
            if ($tentative->getQuestion() === $this) {
                $tentative->setQuestion(null);
            }
        }

        return $this;
    }
}
