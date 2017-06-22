<?php

namespace App\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\FrontBundle\Entity\PlayerRepository")
 */
class Player
{
    
    const NEW_PLAYER = 0;
    const APPROVED = 1;
    const SUBMITTED = 2;
    const REJECTED = 3;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="father_name", type="string", length=255)
     */
    private $fatherName;

    /**
     * @var string
     *
     * @ORM\Column(name="mother_name", type="string", length=255)
     */
    private $motherName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date")
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="birth_place", type="string", length=255)
     */
    private $birthPlace;

    /**
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumn(name="birth_state", referencedColumnName="id")
     */
    private $birthState;

    /**
     * @var string
     *
     * @ORM\Column(name="per_address", type="text")
     */
    private $perAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="mob", type="string", length=255)
     */
    private $mob;

    /**
     * @var string
     *
     * @ORM\Column(name="school_address", type="text")
     */
    private $schoolAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="study_class", type="string", length=255)
     */
    private $studyClass;

    /**
     * @var string
     *
     * @ORM\Column(name="office_address", type="text")
     */
    private $officeAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="blood_group", type="string", length=255)
     */
    private $bloodGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="passport_name", type="string", length=255)
     */
    private $passportName;

    /**
     * @var string
     *
     * @ORM\Column(name="other_name", type="string", length=255)
     */
    private $otherName;

    /**
     * @var string
     *
     * @ORM\Column(name="passport_no", type="string", length=255)
     */
    private $passportNo;

    /**
     * @var string
     *
     * @ORM\Column(name="passport_issue_place", type="string", length=255)
     */
    private $passportIssuePlace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="passport_issue_date", type="date")
     */
    private $passportIssueDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="passport_expiry_date", type="date")
     */
    private $passportExpiryDate;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=255)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255)
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity="District")
     * @ORM\JoinColumn(name="district", referencedColumnName="id")
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=255)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="player_id", type="string", length=255)
     */
    private $playerId;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="birth_certificate", type="string", length=255)
     */
    private $birthCertificate;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Player
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Player
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set fatherName
     *
     * @param string $fatherName
     *
     * @return Player
     */
    public function setFatherName($fatherName)
    {
        $this->fatherName = $fatherName;

        return $this;
    }

    /**
     * Get fatherName
     *
     * @return string
     */
    public function getFatherName()
    {
        return $this->fatherName;
    }

    /**
     * Set motherName
     *
     * @param string $motherName
     *
     * @return Player
     */
    public function setMotherName($motherName)
    {
        $this->motherName = $motherName;

        return $this;
    }

    /**
     * Get motherName
     *
     * @return string
     */
    public function getMotherName()
    {
        return $this->motherName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Player
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     *
     * @return Player
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set birthPlace
     *
     * @param string $birthPlace
     *
     * @return Player
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    /**
     * Get birthPlace
     *
     * @return string
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * Set perAddress
     *
     * @param string $perAddress
     *
     * @return Player
     */
    public function setPerAddress($perAddress)
    {
        $this->perAddress = $perAddress;

        return $this;
    }

    /**
     * Get perAddress
     *
     * @return string
     */
    public function getPerAddress()
    {
        return $this->perAddress;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Player
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Player
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set mob
     *
     * @param string $mob
     *
     * @return Player
     */
    public function setMob($mob)
    {
        $this->mob = $mob;

        return $this;
    }

    /**
     * Get mob
     *
     * @return string
     */
    public function getMob()
    {
        return $this->mob;
    }

    /**
     * Set schoolAddress
     *
     * @param string $schoolAddress
     *
     * @return Player
     */
    public function setSchoolAddress($schoolAddress)
    {
        $this->schoolAddress = $schoolAddress;

        return $this;
    }

    /**
     * Get schoolAddress
     *
     * @return string
     */
    public function getSchoolAddress()
    {
        return $this->schoolAddress;
    }

    /**
     * Set studyClass
     *
     * @param string $studyClass
     *
     * @return Player
     */
    public function setStudyClass($studyClass)
    {
        $this->studyClass = $studyClass;

        return $this;
    }

    /**
     * Get studyClass
     *
     * @return string
     */
    public function getStudyClass()
    {
        return $this->studyClass;
    }

    /**
     * Set officeAddress
     *
     * @param string $officeAddress
     *
     * @return Player
     */
    public function setOfficeAddress($officeAddress)
    {
        $this->officeAddress = $officeAddress;

        return $this;
    }

    /**
     * Get officeAddress
     *
     * @return string
     */
    public function getOfficeAddress()
    {
        return $this->officeAddress;
    }

    /**
     * Set bloodGroup
     *
     * @param string $bloodGroup
     *
     * @return Player
     */
    public function setBloodGroup($bloodGroup)
    {
        $this->bloodGroup = $bloodGroup;

        return $this;
    }

    /**
     * Get bloodGroup
     *
     * @return string
     */
    public function getBloodGroup()
    {
        return $this->bloodGroup;
    }

    /**
     * Set passportName
     *
     * @param string $passportName
     *
     * @return Player
     */
    public function setPassportName($passportName)
    {
        $this->passportName = $passportName;

        return $this;
    }

    /**
     * Get passportName
     *
     * @return string
     */
    public function getPassportName()
    {
        return $this->passportName;
    }

    /**
     * Set otherName
     *
     * @param string $otherName
     *
     * @return Player
     */
    public function setOtherName($otherName)
    {
        $this->otherName = $otherName;

        return $this;
    }

    /**
     * Get otherName
     *
     * @return string
     */
    public function getOtherName()
    {
        return $this->otherName;
    }

    /**
     * Set passportNo
     *
     * @param string $passportNo
     *
     * @return Player
     */
    public function setPassportNo($passportNo)
    {
        $this->passportNo = $passportNo;

        return $this;
    }

    /**
     * Get passportNo
     *
     * @return string
     */
    public function getPassportNo()
    {
        return $this->passportNo;
    }

    /**
     * Set passportIssuePlace
     *
     * @param string $passportIssuePlace
     *
     * @return Player
     */
    public function setPassportIssuePlace($passportIssuePlace)
    {
        $this->passportIssuePlace = $passportIssuePlace;

        return $this;
    }

    /**
     * Get passportIssuePlace
     *
     * @return string
     */
    public function getPassportIssuePlace()
    {
        return $this->passportIssuePlace;
    }

    /**
     * Set passportIssueDate
     *
     * @param \DateTime $passportIssueDate
     *
     * @return Player
     */
    public function setPassportIssueDate($passportIssueDate)
    {
        $this->passportIssueDate = $passportIssueDate;

        return $this;
    }

    /**
     * Get passportIssueDate
     *
     * @return \DateTime
     */
    public function getPassportIssueDate()
    {
        return $this->passportIssueDate;
    }

    /**
     * Set passportExpiryDate
     *
     * @param \DateTime $passportExpiryDate
     *
     * @return Player
     */
    public function setPassportExpiryDate($passportExpiryDate)
    {
        $this->passportExpiryDate = $passportExpiryDate;

        return $this;
    }

    /**
     * Get passportExpiryDate
     *
     * @return \DateTime
     */
    public function getPassportExpiryDate()
    {
        return $this->passportExpiryDate;
    }

    /**
     * Set height
     *
     * @param string $height
     *
     * @return Player
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return Player
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set year
     *
     * @param string $year
     *
     * @return Player
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set playerId
     *
     * @param string $playerId
     *
     * @return Player
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return string
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Player
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set birthCertificate
     *
     * @param string $birthCertificate
     *
     * @return Player
     */
    public function setBirthCertificate($birthCertificate)
    {
        $this->birthCertificate = $birthCertificate;

        return $this;
    }

    /**
     * Get birthCertificate
     *
     * @return string
     */
    public function getBirthCertificate()
    {
        return $this->birthCertificate;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Player
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set birthState
     *
     * @param \App\FrontBundle\Entity\State $birthState
     *
     * @return Player
     */
    public function setBirthState(\App\FrontBundle\Entity\State $birthState = null)
    {
        $this->birthState = $birthState;

        return $this;
    }

    /**
     * Get birthState
     *
     * @return \App\FrontBundle\Entity\State
     */
    public function getBirthState()
    {
        return $this->birthState;
    }

    /**
     * Set district
     *
     * @param \App\FrontBundle\Entity\District $district
     *
     * @return Player
     */
    public function setDistrict(\App\FrontBundle\Entity\District $district = null)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return \App\FrontBundle\Entity\District
     */
    public function getDistrict()
    {
        return $this->district;
    }
    
    /*
     * Get Player FullName
     */
    public function getFullName() 
    {
        return $this->firstName.' '.$this->lastName;
    }
    
    /*
     * Get player status string
     */
    public function getStatusString()
    {
        $status = array(
            self::NEW_PLAYER => 'New',
            self::APPROVED => 'Approved',
            self::SUBMITTED => 'Submitted',
            self::REJECTED => 'Rejected'
        );
        
        return $status[$this->status];
    }
}
