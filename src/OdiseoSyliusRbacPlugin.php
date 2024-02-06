<?php

declare(strict_types=1);

namespace Odiseo\SyliusRbacPlugin;

use Odiseo\SyliusRbacPlugin\Application\MonofonyPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class OdiseoSyliusRbacPlugin extends Bundle
{
    use MonofonyPluginTrait;
}
