<?php

namespace OwenVoke\UnstoppableDomainsSocialite;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Arr;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    public const IDENTIFIER = 'UNSTOPPABLE_DOMAINS';

    private const URL = 'https://auth.unstoppabledomains.com';

    /** {@inheritdoc} */
    protected $scopeSeparator = ' ';

    /** {@inheritdoc} */
    protected $scopes = ['openid', 'email:optional', 'wallet'];

    /** {@inheritdoc} */
    protected $usesPKCE = true;

    /** {@inheritdoc} */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(self::URL.'/authorize', $state);
    }

    /** {@inheritdoc} */
    protected function getTokenUrl()
    {
        return self::URL.'/token';
    }

    /** {@inheritdoc} */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(self::URL.'/userinfo', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /** {@inheritdoc} */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => Arr::get($user, 'sub'),
            'nickname' => Arr::get($user, 'preferred_username'),
            'name' => Arr::get($user, 'name'),
            'email' => Arr::get($user, 'email'),
            'wallet_address' => Arr::get($user, 'wallet_address'),
        ]);
    }

    /** {@inheritdoc} */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
