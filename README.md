# Unstoppable Domains Socialite Adapter

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-github-actions]][link-github-actions]
[![Style CI][ico-styleci]][link-styleci]
[![Total Downloads][ico-downloads]][link-downloads]
[![Buy us a tree][ico-treeware-gifting]][link-treeware-gifting]

An Unstoppable Domains provider for Laravel Socialite

## Install

Via Composer

```shell
composer require owenvoke/socialite-unstoppable-domains
```

Please see the [Base Installation Guide](https://socialiteproviders.com/usage), then follow the provider specific instructions below.

### Add configuration to `config/services.php`

```php
'unstoppable_domains' => [    
    'client_id' => env('UNSTOPPABLE_DOMAINS_CLIENT_ID'),  
    'client_secret' => env('UNSTOPPABLE_DOMAINS_CLIENT_SECRET'),  
    'redirect' => env('UNSTOPPABLE_DOMAINS_REDIRECT_URI') 
],
```

### Add provider event listener

Configure the package's listener to listen for `SocialiteWasCalled` events.

Add the event to your `listen[]` array in `app/Providers/EventServiceProvider`. See the [Base Installation Guide](https://socialiteproviders.com/usage) for detailed instructions.

```php
protected $listen = [
    \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        // ... other providers
        \OwenVoke\UnstoppableDomainsSocialite\UnstoppableDomainsExtendSocialite::class,
    ],
];
```

## Usage

You should now be able to use the provider like you would regularly use Socialite (assuming you have the facade installed):

```php
return Socialite::driver('unstoppable_domains')->with(['login_hint' => $domain])->redirect();
```

> Note, you are required to pass in the `login_hint` which is the domain that the user provided.

By default the `email:optional` scope is provided, if you want to require an email address to be returned, use the following:

```php
return Socialite::driver('unstoppable_domains')->with(['login_hint' => $domain])->scopes(['email'])->redirect();
```

### Returned User fields

- `id`: The id (domain) of the authenticated user
- `email`: The email address of the user (optional by default)
- `wallet_address`: The wallet address of the user
- `user`
  - `sub`: The domain of the authenticated user
  - `wallet_address`: The wallet address of the user
  - `wallet_type_hint`: The method of wallet authentication the user used
  - `email`: The email address of the user (optional by default)
  - `email_verified`: A boolean stating whether the user's email has been verified (optional by default)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```shell
composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@voke.dev instead of using the issue tracker.

## Credits

- [Owen Voke][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment you are required to buy the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to plant trees. If you support this package and contribute to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees [here][link-treeware-gifting].

Read more about Treeware at [treeware.earth][link-treeware].

[ico-version]: https://img.shields.io/packagist/v/owenvoke/socialite-unstoppable-domains.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-github-actions]: https://img.shields.io/github/workflow/status/owenvoke/socialite-unstoppable-domains/Tests.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/440505448/shield
[ico-downloads]: https://img.shields.io/packagist/dt/owenvoke/socialite-unstoppable-domains.svg?style=flat-square
[ico-treeware-gifting]: https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-lightgreen?style=flat-square

[link-packagist]: https://packagist.org/packages/owenvoke/socialite-unstoppable-domains
[link-github-actions]: https://github.com/owenvoke/socialite-unstoppable-domains/actions
[link-styleci]: https://styleci.io/repos/440505448
[link-downloads]: https://packagist.org/packages/owenvoke/socialite-unstoppable-domains
[link-treeware]: https://treeware.earth
[link-treeware-gifting]: https://ecologi.com/owenvoke?gift-trees
[link-author]: https://github.com/owenvoke
[link-contributors]: ../../contributors
