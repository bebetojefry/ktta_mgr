<?php

namespace App\FrontBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use App\FrontBundle\Entity\Product;
use App\FrontBundle\Entity\Player;;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\FrontBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;

class AppFrontBundle extends Bundle
{
    public function boot()
    {
        Product::setUploadDir($this->container->getParameter('products_upload_dir'));
        Player::setUploadDir($this->container->getParameter('players_upload_dir'));
        Player::setIdPath($this->container->getParameter('players_id_path'));
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new OverrideServiceCompilerPass());
    }
}
