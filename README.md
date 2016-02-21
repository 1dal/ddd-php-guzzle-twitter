# DDD PHP Guzzle Twitter

Sample DDD exercise. Simple REST API end point to query the latests tweets of a user.

- Based on symfony3.
- Use of Guzzle library with OAuth authentication.

## Installation

- Create a Twitter application to obtain a token and token secret. See [https://apps.twitter.com/](https://apps.twitter.com/).
- `$ composer install` to install dependencies. **It will ask you to provide: `consumer_key`, `consumer_secret`, `token` and `token_secret`.**
- Run with `$ php bin/console server:run` and open `http://127.0.0.1:8000`.

## API

- API end point is defined as `/api/{username}`, you can also provide a `count` query property to limit the number of 
tweets to retrieve, i.e.: `/api/{username}?count=15`. If not specified by default it will retrieve the latest ten tweets.

- All request return a JSON string with:
    - `code`: Status code of the operation. `200` ok, `404` resource (username) do not exists, `401`unauthorized, etc.
    - `message`: String with a descriptive message of the previos code. Empty if `code=200`
    - `data`: Array with the retreived set of tweets.

## The application

The goal is simple: Create an API end point that retrieve the N latest tweets given a username.

### Domain Layer

All DDD related code is located at the `\CoreDomain` namespace, it defines our domain and is isolated from any framework
related technology or requirement. **It doesn't use any symfony class and is located outside any bundle.**

For this example our domain model is really simply, a single `Tweet` entity class that represents a tweet written by a given user.
To allow get tweets our domain offers an entry point, the `TweetService` service, that the application layer (for example symfony controllers) can use.

In addition, to retrieve tweets we have a `TweetRepository`, responsible to query tweets using infrastructure mechanisms and convert the data to
`Tweet` instances. For this purpose, we have created a `TweetFactory`, which allows us to *reconstitute* `Tweet` instance 
from the storage format used by Twitter.

> Note, `TweetRepository` is an interface that defines the methods needed from the domain layer point of view. Usually concrete
repository implementations are coded within the infrastructure layer.

Our domain has also a `UserNotFoundException` that is thrown by the service if a given username do not exists.

The key is to create domain layer isolated and that contains all our business logic. The `TweetService` can be used from an API end point, a form or whatever.

### Application Layer

The code for the application layer is located within the `AppBundle`. It is realted with the framework we use, in this case symfony3.

Our application layer is composed by a single end point implemented in the `AppBundle\Controller\TwitterController.php` class.
It is responsible to check the `username` is passed or if the optional `count` parameter is present in the request.

The controller retrieves an array of `Tweet` instances using the `CoreDomain\TweetService` and is also responsible to 
serialize the response in the desired format. In this example JSON.

All the business logic is places in the domain layer.

### Infrastructure Layer

This is responsible to *talk* with external resources, like Twitter. For this example, we have implemented a the
`AppBundle\Repository\GuzzleTweetRepository.php` class, which implements the `CoreDomain\TweetRepository` interface, using the 
Guzzle library.

## Putting all together (dependency injection)




## Resources

* Help configuring Guzzle: [http://derekmd.com/2015/06/updating-twitter-oauth-in-symfony-for-guzzle-6-0/](http://derekmd.com/2015/06/updating-twitter-oauth-in-symfony-for-guzzle-6-0/)
