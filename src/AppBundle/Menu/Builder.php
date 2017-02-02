<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
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
     * @param FactoryInterface $factory
     * @param array            $options
     *
     * @return ItemInterface
     */
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $this->addItem($menu, 'nav.admin.title', 'admin', 'home');

        return $menu;
    }

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
