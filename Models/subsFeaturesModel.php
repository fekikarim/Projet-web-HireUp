<?php

require_once __DIR__ . '/../config.php';

class SubsFeaturesModel
{
    private $feature_id;
    private $subscription_id;
    private $feature_name;
    private $description;

    public function __construct($feature_id, $subscription_id, $feature_name, $description)
    {
        $this->feature_id = $feature_id;
        $this->subscription_id = $subscription_id;
        $this->feature_name = $feature_name;
        $this->description = $description;
    }

    public function getFeatureId()
    {
        return $this->feature_id;
    }

    public function setFeatureId($feature_id)
    {
        $this->feature_id = $feature_id;
    }

    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    public function setSubscriptionId($subscription_id)
    {
        $this->subscription_id = $subscription_id;
    }

    public function getFeatureName()
    {
        return $this->feature_name;
    }

    public function setFeatureName($feature_name)
    {
        $this->feature_name = $feature_name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}

?>
