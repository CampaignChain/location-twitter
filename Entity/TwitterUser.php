<?php
/*
 * Copyright 2016 CampaignChain, Inc. <info@campaignchain.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace CampaignChain\Location\TwitterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CampaignChain\CoreBundle\Util\ParserUtil;

/**
 * @ORM\Entity
 * @ORM\Table(name="campaignchain_location_twitter_user")
 */
class TwitterUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="CampaignChain\CoreBundle\Entity\Location")
     */
    protected $location;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $identifier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $displayName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $profileUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $profileImageUrl;

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
     * Set username
     *
     * @param string $username
     * @return TwitterUser
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return TwitterUser
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string 
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return TwitterUser
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set profileUrl
     *
     * @param string $profileUrl
     * @return TwitterUser
     */
    public function setProfileUrl($profileUrl)
    {
        $this->profileUrl = ParserUtil::sanitizeUrl($profileUrl);

        return $this;
    }

    /**
     * Get profileUrl
     *
     * @return string 
     */
    public function getProfileUrl()
    {
        return $this->profileUrl;
    }

    /**
     * Set profileImageUrl
     *
     * @param string $profileImageUrl
     * @return TwitterUser
     */
    public function setProfileImageUrl($profileImageUrl)
    {
        $this->profileImageUrl = $profileImageUrl;

        return $this;
    }

    /**
     * Get profileImageUrl
     *
     * @return string 
     */
    public function getProfileImageUrl()
    {
        return $this->profileImageUrl;
    }

    /**
     * Set location
     *
     * @param \CampaignChain\CoreBundle\Entity\Location $location
     * @return TwitterUser
     */
    public function setLocation(\CampaignChain\CoreBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \CampaignChain\CoreBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }
}
