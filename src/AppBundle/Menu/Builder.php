<?php

namespace AppBundle\Menu;

use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Builder
 */
class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param ItemInterface $menuItem
     * @param string        $label
     * @param string|null   $route
     * @param string|null   $icon
     * @param array         $routeParameters
     * @param string|null   $role
     *
     * @return ItemInterface|boolean
     */
    public function addItem(
        ItemInterface $menuItem,
        $label,
        $route = null,
        $icon = null,
        $routeParameters = [],
        $role = null
    ) {
        if ($role !== null && !$this->getAuthorization()->isGranted($role)) {
            return null;
        }

        if ($route === null) {
            $routeSetting = [];
        } else {
            $routeSetting = [
                'route' => $route,
            ];
        }

        if (!empty($routeParameters)) {
            $routeSetting['routeParameters'] = $routeParameters;
        }

        $item = $menuItem->addChild($this->getTranslator()->trans($label), $routeSetting);

        if (!empty($icon)) {
            $item->setAttribute('icon', 'fa fa-'.$icon);
        }

        if ($menuItem->isRoot() === true) {
            $item->setExtra('title', true);
        }

        return $item;
    }

    /**
     * @param               $prefix
     * @param ItemInterface $menuItem
     * @param               $route
     * @param               $label
     * @param null          $icon
     * @param array         $routeParameters
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
    ) {
        $routeName = $this->getRequest()->get('_route');
        if (strpos($routeName, $prefix) === 0) {
            $menuItem = $this->addItem($menuItem, $label, $route, $icon, $routeParameters);
        }

        return $menuItem;
    }

    /**
     * @return TranslatorInterface
     */
    public function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * @return AuthorizationCheckerInterface
     */
    public function getAuthorization()
    {
        return $this->container->get('security.authorization_checker');
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }
}
