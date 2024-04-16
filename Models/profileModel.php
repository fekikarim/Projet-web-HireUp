<?php

require_once __DIR__ . '/../config.php';

class ProfileModel
{
    // Profile attributes
    private $profile_id;
    private $profile_first_name;
    private $profile_family_name;
    private $profile_userid;
    private $profile_phone_number;
    private $profile_region;
    private $profile_city;
    private $profile_bio;
    private $profile_current_position;
    private $profile_education;
    private $profile_subscription;
    private $profile_auth;
    private $profile_acc_verif;
    private $profile_photo;
    private $profile_cover;

    // Constructor
    public function __construct($profile_id = null)
    {
        if ($profile_id) {
            // Fetch profile details from database and set them
            $this->loadProfile($profile_id);
        }
    }

    // Load profile details from the database
    public function loadProfile($profile_id)
    {
        $pdo = Config::getConnection();
        $tableName = "profile";

        $query = $pdo->prepare("SELECT * FROM $tableName WHERE profile_id = :profile_id");
        $query->execute(['profile_id' => $profile_id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Set profile attributes
        $this->setProfileId($result['profile_id']);
        $this->setProfileFirstName($result['profile_first_name']);
        $this->setProfileFamilyName($result['profile_family_name']);
        $this->setProfileUserId($result['profile_userid']);
        $this->setProfilePhoneNumber($result['profile_phone_number']);
        $this->setProfileRegion($result['profile_region']);
        $this->setProfileCity($result['profile_city']);
        $this->setProfileBio($result['profile_bio']);
        $this->setProfileCurrentPosition($result['profile_current_position']);
        $this->setProfileEducation($result['profile_education']);
        $this->setProfileSubscription($result['profile_subscription']);
        $this->setProfileAuth($result['profile_auth']);
        $this->setProfileAccVerif($result['profile_acc_verif']);
        $this->setProfilePhoto($result['profile_photo']);
        $this->setProfileCover($result['profile_cover']);
    }

    // Getters and setters for profile attributes
    public function getProfileId()
    {
        return $this->profile_id;
    }

    public function setProfileId($profile_id)
    {
        $this->profile_id = $profile_id;
    }

    public function getProfileFirstName()
    {
        return $this->profile_first_name;
    }

    public function setProfileFirstName($profile_first_name)
    {
        $this->profile_first_name = $profile_first_name;
    }

    public function getProfileFamilyName()
    {
        return $this->profile_family_name;
    }

    public function setProfileFamilyName($profile_family_name)
    {
        $this->profile_family_name = $profile_family_name;
    }

    public function getProfileUserId()
    {
        return $this->profile_userid;
    }

    public function setProfileUserId($profile_userid)
    {
        $this->profile_userid = $profile_userid;
    }

    public function getProfilePhoneNumber()
    {
        return $this->profile_phone_number;
    }

    public function setProfilePhoneNumber($profile_phone_number)
    {
        $this->profile_phone_number = $profile_phone_number;
    }

    public function getProfileRegion()
    {
        return $this->profile_region;
    }

    public function setProfileRegion($profile_region)
    {
        $this->profile_region = $profile_region;
    }

    public function getProfileCity()
    {
        return $this->profile_city;
    }

    public function setProfileCity($profile_city)
    {
        $this->profile_city = $profile_city;
    }

    public function getProfileBio()
    {
        return $this->profile_bio;
    }

    public function setProfileBio($profile_bio)
    {
        $this->profile_bio = $profile_bio;
    }

    public function getProfileCurrentPosition()
    {
        return $this->profile_current_position;
    }

    public function setProfileCurrentPosition($profile_current_position)
    {
        $this->profile_current_position = $profile_current_position;
    }

    public function getProfileEducation()
    {
        return $this->profile_education;
    }

    public function setProfileEducation($profile_education)
    {
        $this->profile_education = $profile_education;
    }

    public function getProfileSubscription()
    {
        return $this->profile_subscription;
    }

    public function setProfileSubscription($profile_subscription)
    {
        $this->profile_subscription = $profile_subscription;
    }

    public function getProfileAuth()
    {
        return $this->profile_auth;
    }

    public function setProfileAuth($profile_auth)
    {
        $this->profile_auth = $profile_auth;
    }

    public function getProfileAccVerif()
    {
        return $this->profile_acc_verif;
    }

    public function setProfileAccVerif($profile_acc_verif)
    {
        $this->profile_acc_verif = $profile_acc_verif;
    }

    public function getProfilePhoto()
    {
        return $this->profile_photo;
    }

    public function setProfilePhoto($profile_photo)
    {
        $this->profile_photo = $profile_photo;
    }

    public function getProfileCover()
    {
        return $this->profile_cover;
    }

    public function setProfileCover($profile_cover)
    {
        $this->profile_cover = $profile_cover;
    }

    public function getProfilePhotoAsBase64()
    {
        // Check if profile photo is set
        if ($this->profile_photo) {
            // Convert binary data to base64 encoded string
            $base64_photo = base64_encode($this->profile_photo);
            // Generate data URI for image
            $data_uri_photo = 'data:image/*;base64,' . $base64_photo;
            return $data_uri_photo;
        } else {
            return null;
        }
    }

    public function getProfileCoverAsBase64()
    {
        // Check if profile cover is set
        if ($this->profile_cover) {
            // Convert binary data to base64 encoded string
            $base64_cover = base64_encode($this->profile_cover);
            // Generate data URI for image
            $data_uri_cover = 'data:image/*;base64,' . $base64_cover;
            return $data_uri_cover;
        } else {
            return null;
        }
    }
}
