<?php

namespace AppBundle\Menu;

use AppBundle\Entity\User;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use AppBundle\Menu\Builder as BaseBuilder;

/**
 * Class AdminBuilder
 */
class AdminBuilder extends BaseBuilder
{
    /**
     * @param FactoryInterface $factory
     * @param array            $options
     *
     * @return ItemInterface
     */
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $this->addItem($menu, 'admin.nav.home', 'admin_homepage', 'home');

        if ($this->getAuthorization()->isGranted(User::USER_ROLE_SUPER_ADMIN)) {
            $this->addItem($menu, 'admin.nav.log', 'admin_log_index', 'file-text');
        }

        return $menu;
    }

    /**
     * @param FactoryInterface $factory
     *
     * @return ItemInterface
     */
    public function breadcrumb(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        if ($this->getAuthorization()->isGranted(User::USER_ROLE_SUPER_ADMIN)) {
            $this->addItemIfRouteMatch('admin_log_index', $menu, 'admin_log_index', 'admin.nav.log', 'file-text');
        }

        return $menu;
    }
}
