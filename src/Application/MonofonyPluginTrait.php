<?php

declare(strict_types=1);

namespace Odiseo\SyliusRbacPlugin\Application;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

trait MonofonyPluginTrait
{
    /** @var ExtensionInterface|null */
    private $containerExtension;

    /**
     * Returns the plugin's container extension.
     *
     * @return ExtensionInterface|null The container extension
     *
     * @throws \LogicException
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->containerExtension) {
            $extension = $this->createContainerExtension();

            if (null !== $extension) {
                if (!$extension instanceof ExtensionInterface) {
                    throw new \LogicException(sprintf('Extension %s must implement %s.', get_class($extension), ExtensionInterface::class));
                }

                // check naming convention for Sylius Plugins
                $basename = preg_replace('/Plugin$/', '', $this->getName());
                $expectedAlias = Container::underscore($basename);

                if ($expectedAlias !== $extension->getAlias()) {
                    throw new \LogicException(sprintf(
                        'Users will expect the alias of the default extension of a plugin to be the underscored version of the plugin name ("%s"). You can override "Bundle::getContainerExtension()" if you want to use "%s" or another alias.',
                        $expectedAlias, $extension->getAlias()
                    ));
                }

                $this->containerExtension = $extension;
            } else {
                $this->containerExtension = null;
            }
        }

        return $this->containerExtension;
    }

    /**
     * Creates the bundle's container extension.
     *
     * @return ExtensionInterface|null
     */
    abstract protected function createContainerExtension();

    /**
     * Returns the bundle name (the class short name).
     *
     * @return string The Bundle name
     */
    abstract protected function getName();

    /**
     * Gets the Bundle namespace.
     *
     * @return string The Bundle namespace
     */
    abstract protected function getNamespace();

    /**
     * Returns the plugin's container extension class.
     */
    protected function getContainerExtensionClass(): string
    {
        $basename = preg_replace('/Plugin$/', '', $this->getName());

        return $this->getNamespace() . '\\DependencyInjection\\' . $basename . 'Extension';
    }
}
