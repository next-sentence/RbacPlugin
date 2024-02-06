<?php

declare(strict_types=1);

namespace Odiseo\SyliusRbacPlugin\Form\Extension;

use Sylius\Bundle\UserBundle\Form\Type\UserType;
use Odiseo\SyliusRbacPlugin\Form\Type\AdministrationRoleChoiceType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class AdminUserTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('administrationRole', AdministrationRoleChoiceType::class, [
            'required' => true,
        ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [UserType::class];
    }
}
