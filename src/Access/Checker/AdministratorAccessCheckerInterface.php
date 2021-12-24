<?php

declare(strict_types=1);

namespace Odiseo\SyliusRbacPlugin\Access\Checker;

use Sylius\Component\User\Model\UserInterface;
use Odiseo\SyliusRbacPlugin\Access\Model\AccessRequest;

interface AdministratorAccessCheckerInterface
{
    public function canAccessSection(UserInterface $admin, AccessRequest $accessRequest): bool;
}
