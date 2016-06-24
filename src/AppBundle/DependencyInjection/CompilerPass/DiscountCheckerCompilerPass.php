<?php

namespace AppBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DiscountCheckerCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		if (false === $container->hasDefinition('my_app.discount_manager')) {
			return;
		}
		$definition = $container->getDefinition('my_app.discount_manager');
		
		foreach ($container->findTaggedServiceIds('discount_checker') as $id => $attributes) {
			$definition->addMethodCall('addDiscountChecker', [new Reference($id)]);
		}
	}
}