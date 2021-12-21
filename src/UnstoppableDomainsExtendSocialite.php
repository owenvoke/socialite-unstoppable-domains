<?php

declare(strict_types=1);

namespace OwenVoke\UnstoppableDomainsSocialite;

use SocialiteProviders\Manager\SocialiteWasCalled;

class UnstoppableDomainsExtendSocialite
{
    public function __invoke(SocialiteWasCalled $socialiteWasCalled): void
    {
        $socialiteWasCalled->extendSocialite('unstoppable_domains', Provider::class);
    }
}
