<?php

declare(strict_types=1);

namespace spec\Sylius\RbacPlugin\Entity;

use PhpSpec\ObjectBehavior;
use Sylius\RbacPlugin\Entity\AdministrationRoleInterface;
use Sylius\RbacPlugin\Model\Permission;

final class AdministrationRoleSpec extends ObjectBehavior
{
    function it_implements_administration_role_interface(): void
    {
        $this->shouldImplement(AdministrationRoleInterface::class);
    }

    function it_has_name(): void
    {
        $this->setName('Root');
        $this->getName()->shouldReturn('Root');
    }

    function it_has_permissions(): void
    {
        $this->addPermission(Permission::catalogManagement());
        $this->addPermission(Permission::customerManagement());

        $this->hasPermission(Permission::catalogManagement())->shouldReturn(true);
        $this->hasPermission(Permission::customerManagement())->shouldReturn(true);

        $this->removePermission(Permission::customerManagement());
        $this->hasPermission(Permission::customerManagement())->shouldReturn(false);
    }
}
