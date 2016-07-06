<?php
/**
 *
 * This file is part of the CampaignChain package.
 *
 * (c) CampaignChain, Inc. <info@campaignchain.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace CampaignChain\Location\TwitterBundle\Job;

use CampaignChain\CoreBundle\Entity\Location;
use CampaignChain\CoreBundle\Entity\SchedulerReportLocation;
use CampaignChain\CoreBundle\Job\JobReportInterface;
use Doctrine\ORM\EntityManager;

class ReportTwitterUserMetrics implements JobReportInterface
{
    const BUNDLE_NAME = 'campaignchain/location-twitter';
    const METRIC_FOLLOWERS = 'Followers';

    protected $em;
    protected $container;

    protected $message;

    public function __construct(EntityManager $em, $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function schedule($location, $facts = null)
    {
        $scheduler = new SchedulerReportLocation();
        $scheduler->setLocation($location);
        $scheduler->setInterval('1 hour');
        $this->em->persist($scheduler);

        $facts[self::METRIC_FOLLOWERS] = 0;

        $factService = $this->container->get('campaignchain.core.fact');
        $factService->addLocationFacts(self::BUNDLE_NAME, $location, $facts);

    }

    public function execute($locationId)
    {
        $client = $this->container->get('campaignchain.channel.twitter.rest.client');
        $location = $this->em->getRepository('CampaignChainCoreBundle:Location')->find($locationId);
        $connection = $client->connectByLocation($location);

        if ($connection) {

            $request = $connection->get('users/show.json?user_id='.$location->getIdentifier());
            $response = $request->send()->json();
            $followers = $response['followers_count'];
        } else {
            return self::STATUS_ERROR;
        }

        // Add report data.
        $facts[self::METRIC_FOLLOWERS] = $followers;

        $factService = $this->container->get('campaignchain.core.fact');
        $factService->addLocationFacts(self::BUNDLE_NAME, $location, $facts);

        $this->message = 'Added to report: followers = '.$followers . '.';

        return self::STATUS_OK;
    }

    public function getMessage(){
        return $this->message;
    }
}
