<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvRepository::class)]
class Cv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $postal = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $linkedin = null;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: ProfessionalExperience::class, cascade: ['persist'])]
    private Collection $professionalExperiences;

    #[ORM\ManyToMany(targetEntity: Diploma::class, inversedBy: 'cvs', cascade: ['persist'])]
    private Collection $diploma;

    #[ORM\ManyToMany(targetEntity: Skill::class, inversedBy: 'cvs', cascade: ['persist'])]
    private Collection $skill;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'cvs', cascade: ['persist'])]
    private Collection $language;

    #[ORM\ManyToMany(targetEntity: Hobby::class, inversedBy: 'cvs', cascade: ['persist'])]
    private Collection $hobby;

    #[ORM\Column(length: 255)]
    private ?string $color_first = null;

    #[ORM\Column(length: 255)]
    private ?string $color_second = null;


    public function __construct()
    {
        $this->professionalExperiences = new ArrayCollection();
        $this->diploma = new ArrayCollection();
        $this->skill = new ArrayCollection();
        $this->language = new ArrayCollection();
        $this->hobby = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPostal(): ?string
    {
        return $this->postal;
    }

    public function setPostal(string $postal): self
    {
        $this->postal = $postal;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * @return Collection<int, ProfessionalExperience>
     */
    public function getProfessionalExperiences(): Collection
    {
        return $this->professionalExperiences;
    }

    public function addProfessionalExperience(ProfessionalExperience $professionalExperience): self
    {
        if (!$this->professionalExperiences->contains($professionalExperience)) {
            $this->professionalExperiences->add($professionalExperience);
            $professionalExperience->setCv($this);
        }

        return $this;
    }

    public function removeProfessionalExperience(ProfessionalExperience $professionalExperience): self
    {
        if ($this->professionalExperiences->removeElement($professionalExperience)) {
            // set the owning side to null (unless already changed)
            if ($professionalExperience->getCv() === $this) {
                $professionalExperience->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Diploma>
     */
    public function getDiploma(): Collection
    {
        return $this->diploma;
    }

    public function addDiploma(Diploma $diploma): self
    {
        if (!$this->diploma->contains($diploma)) {
            $this->diploma->add($diploma);
        }

        return $this;
    }

    public function removeDiploma(Diploma $diploma): self
    {
        $this->diploma->removeElement($diploma);

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkill(): Collection
    {
        return $this->skill;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skill->contains($skill)) {
            $this->skill->add($skill);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        $this->skill->removeElement($skill);

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getLanguage(): Collection
    {
        return $this->language;
    }

    public function addLanguage(Language $language): self
    {
        if (!$this->language->contains($language)) {
            $this->language->add($language);
        }

        return $this;
    }

    public function removeLanguage(Language $language): self
    {
        $this->language->removeElement($language);

        return $this;
    }

    /**
     * @return Collection<int, Hobby>
     */
    public function getHobby(): Collection
    {
        return $this->hobby;
    }

    public function addHobby(Hobby $hobby): self
    {
        if (!$this->hobby->contains($hobby)) {
            $this->hobby->add($hobby);
        }

        return $this;
    }

    public function removeHobby(Hobby $hobby): self
    {
        $this->hobby->removeElement($hobby);

        return $this;
    }

    public function getColorFirst(): ?string
    {
        return $this->color_first;
    }

    public function setColorFirst(string $color_first): self
    {
        $this->color_first = $color_first;

        return $this;
    }

    public function getColorSecond(): ?string
    {
        return $this->color_second;
    }

    public function setColorSecond(string $color_second): self
    {
        $this->color_second = $color_second;

        return $this;
    }

}
