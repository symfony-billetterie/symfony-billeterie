<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use AppBundle\Menu\Builder as BaseBuilder;

/**
 * Class AdminBuilder
 *
 * @package AppBundle\Menu
 */
class AdminBuilder extends BaseBuilder
{
    /**
     * @param FactoryInterface $factory
     * @param array $options
     *
     * @return ItemInterface
     */
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $this->addItem($menu, 'admin.nav.home', 'admin_homepage', 'home');
        $this->addItem($menu, 'admin.nav.event_type', 'index_event_type', 'list');

        return $menu;
    }

    /**
     * @param FactoryInterface $factory
     * @param array $options
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function breadcrumb(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        return $menu;
    }

    /**
     * @param $prefix
     * @param ItemInterface $menuItem
     * @param $route
     * @param $label
     * @param null $icon
     * @param array $routeParameters
     *
     * @return bool|ItemInterface
     */
    public function addItemIfRouteMatch(
        $prefix,
        ItemInterface $menuItem,
        $route,
        $label,
        $icon = null,
        $routeParameters = []
    )
    {
        $routeName = $this->getRequest()->get('_route');
        if (strpos($routeName, $prefix) === 0) {
            $menuItem = $this->addItem($menuItem, $label, $route, $icon, $routeParameters);
        }

        return $menuItem;
    }
}
