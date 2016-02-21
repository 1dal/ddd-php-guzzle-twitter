<?php

namespace AppBundle\Controller;

use AppBundle\Helper\TweetSerializer;
use CoreDomain\UserNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use \Exception;

/**
 * Class TwitterController defines methods to access Twitter API.
 *
 * @Route("/api")
 * @package AppBundle\Controller
 */
class TwitterController extends Controller
{
    /**
     * Retrieves the 'count' latests tweets from a given username.
     *
     * @Route("/{username}")
     * @Method("GET")
     *
     * @param Request $request
     * @param $username Username from who retrieve the tweets.
     *
     * @return JsonResponse
     */
    public function queryTweetsAction(Request $request, $username)
    {
        // Retrieve 'count' query parameter.
        $count = $request->get('count');

        $arrayRepresentation = [];
        $code = 200;
        $message = "";
        try {
            // Retrieve tweets through domain service
            $twitterService = $this->get('domain.twitter.service');
            $tweets = $twitterService->getTweetsByUsername($username, $count);

            // Serialize data and return response
            $arrayRepresentation = TweetSerializer::serializeTweets($tweets);
        } catch (UserNotFoundException $ex) {
            $code = $ex->getCode();
            $message = $ex->getMessage();
        } catch (Exception $ex) {
            $code = $ex->getCode();
            $message = $ex->getMessage();
        }

        $response = new JsonResponse();
        $response->setData(array(
            "code" => $code,
            "message" => $message,
            "data" => $arrayRepresentation
        ));
        return $response;
    }
}
