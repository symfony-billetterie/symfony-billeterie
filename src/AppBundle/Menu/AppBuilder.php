<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use AppBundle\Menu\Builder as BaseBuilder;

/**
 * Class AppBuilder
 */
class AppBuilder extends BaseBuilder
{
    /**
     * @param FactoryInterface $factory
     *
     * @return ItemInterface
     */
    public function mainMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');

        $this->addItem($menu, 'app.nav.article', 'homepage');

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
        $this->addItemIfRouteMatch('homepage', $menu, 'homepage', 'app.nav.article', 'newspaper-o');

        return $menu;
    }

    /**
     * @param               $prefix
     * @param ItemInterface $menuItem
     * @param               $route
     * @param               $label
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
