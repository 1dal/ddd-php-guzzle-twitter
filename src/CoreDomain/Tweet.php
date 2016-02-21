<?php

namespace CoreDomain;


/**
 * Class Tweet, contains Tweet information. See: https://dev.twitter.com/overview/api/tweets
 *
 * @package CoreDomain
 */
class Tweet
{
    private $id;
    private $text;
    private $created_at;

    /**
     * Tweet constructor.
     * @param $id
     * @param $text
     * @param $created_at
     */
    public function __construct($id, $text, $created_at)
    {
        $this->id = $id;
        $this->text = $text;
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
}