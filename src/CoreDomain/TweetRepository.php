<?php

namespace CoreDomain;

/**
 * Interface TweetRepository defines the common methods a concrete TweetRepository class must implement.
 *
 * @package CoreDomain
 */
interface TweetRepository
{
    /**
     * Returns an array with the latests 'count' tweets from a given user.
     *
     * @param $username The username
     * @param $count Number of tweets to retrieve.
     *
     * @throws UserNotFoundException if username do not exists.
     *
     * @return array of Tweet instances
     */
    public function findByUsername($username, $count);
}