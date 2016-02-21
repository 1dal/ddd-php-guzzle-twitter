<?php

namespace CoreDomain;

/**
 * Class TweetFactory encapsulates all the business logic need to create a Tweet. In this example it is also used
 * by the TweetRepository to reconstitute tweets.
 *
 * @package CoreDomain
 */
class TweetFactory
{

    public static function createTweetsFromArrayObjects($objectArray)
    {
        $result = [];
        foreach($objectArray as $object) {
            $result[] = TweetFactory::createTweet($object->id, $object->text, $object->created_at);
        }
        return $result;
    }

    /**
     * Creates a new CoreDomain\Tweet instance given a set of values.
     *
     * @param $id
     * @param $text
     * @param $created_at
     * @return Tweet
     */
    public static function createTweet($id, $text, $created_at)
    {
        return new Tweet($id, $text, $created_at);
    }
}