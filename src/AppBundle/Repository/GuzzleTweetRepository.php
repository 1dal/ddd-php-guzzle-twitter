<?php

namespace AppBundle\Repository;

use CoreDomain\TweetRepository;
use CoreDomain\TweetFactory;
use CoreDomain\UserNotFoundException;
use GuzzleHttp\Client;
use \Exception;


/**
 * Class GuzzleTweetRepository is a concrete implementation of CoreDomain\TweetRepository based on Guzzle library.
 *
 * @package AppBundle\Repository
 */
class GuzzleTweetRepository implements TweetRepository
{
    private $client;

    /**
     * GuzzleTweetRepository constructor.
     *
     * @param Client $client Instance of Guzzle client.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @inheritdoc
     */
    public function findByUsername($username, $count)
    {
        try {
            $body = $this->client->get('statuses/user_timeline.json?screen_name=' . $username . '&count=' . $count)->getBody();
            $responseArray = json_decode($body);
            $tweets = TweetFactory::createTweetsFromArrayObjects($responseArray);
            return $tweets;
        } catch (Exception $ex) {
            if ($ex->getCode() == 404) {
                throw new UserNotFoundException($username);
            }
            throw $ex;
        }
    }
}
