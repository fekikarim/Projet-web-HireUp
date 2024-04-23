<?php

require_once __DIR__ . '/../config.php';

class SubscriptionModel
{
    // Properties
    private $subscription_id;
    private $plan_name;
    private $duration;
    private $price;
    private $description;
    private $subscription_status;

    // Constructor
    public function __construct($subscription_id, $plan_name, $duration, $price, $description, $subscription_status)
    {
        $this->subscription_id = $subscription_id;
        $this->plan_name = $plan_name;
        $this->duration = $duration;
        $this->price = $price;
        $this->description = $description;
        $this->subscription_status = $subscription_status;
    }

    // Getters and Setters
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    public function setSubscriptionId($subscription_id)
    {
        $this->subscription_id = $subscription_id;
    }

    public function getPlanName()
    {
        return $this->plan_name;
    }

    public function setPlanName($plan_name)
    {
        $this->plan_name = $plan_name;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getSubscriptionStatus()
    {
        return $this->subscription_status;
    }

    public function setSubscriptionStatus($subscription_status)
    {
        $this->subscription_status = $subscription_status;
    }

}
