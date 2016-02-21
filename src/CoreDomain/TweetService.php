<?php

namespace CoreDomain;


/**
 * Class TweetService is the entry point to our domain ayer and implements those actions related with tweets.
 *
 * @package CoreDomain
 */
class TweetService
{
    const DEFAULT_TWEETS = 10;

    private $repository;

    /**
     * TweetService constructor.
     * @param TweetRepository $repository
     */
    public function __construct(TweetRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Returns an array with the latests 'count' tweets from a given user.
     *
     * @param $username The username
     * @param $count Number of tweets to retrieve. (default=10)
     * @return array of Tweet instances
     */
    public function getTweetsByUsername($username, $count = TweetService::MAX_TWEETS) {
        return $this->repository->findByUsername($username, $count);
    }
}