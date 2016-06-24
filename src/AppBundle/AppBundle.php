<?php

namespace AppBundle;

use AppBundle\DependencyInjection\CompilerPass\DiscountCheckerCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		$container->addCompilerPass(new DiscountCheckerCompilerPass());
	}
}
