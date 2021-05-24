<?php

namespace FiveamCode\LaravelNotionApi\Endpoints;

use FiveamCode\LaravelNotionApi\Entities\User;
use FiveamCode\LaravelNotionApi\Entities\Collections\UserCollection;
use FiveamCode\LaravelNotionApi\Exceptions\HandlingException;
use Illuminate\Support\Collection;

class Users extends Endpoint implements EndpointInterface
{

    /**
     * List users
     * url: https://api.notion.com/{version}/users
     * notion-api-docs: https://developers.notion.com/reference/get-users
     *
     * @return UserCollection
     */
    public function all(): UserCollection
    {
        $resultData = $this->getJson($this->url(Endpoint::USERS) . "?{$this->buildPaginationQuery()}");

        return new UserCollection($resultData);
    }

    /**
     * Retrieve a user
     * url: https://api.notion.com/{version}/users/{user_id}
     * notion-api-docs: https://developers.notion.com/reference/get-user
     *
     * @param string $userId
     * @return array
     */
    public function find(string $userId): User
    {
        $response = $this->get(
            $this->url(Endpoint::USERS . "/" . $userId)
        );

        return new User($response->json());
    }
}
