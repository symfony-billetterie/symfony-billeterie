<?php

namespace AppBundle\Menu;

use AppBundle\Entity\User;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use AppBundle\Menu\Builder as BaseBuilder;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminBuilder
 */
class AdminBuilder extends BaseBuilder
{
    /**
     * @param FactoryInterface $factory
     *
     * @return ItemInterface
     */
    public function mainMenu(FactoryInterface $factory)
    {
        /** @var Request $request */
        $request   = $this->getRequest();
        $routeName = $request->get('_route');
        $menu      = $factory->createItem('root');
        $this->addItem($menu, 'admin.nav.home', 'admin_homepage', 'home');

        if ($this->getAuthorization()->isGranted(User::USER_ROLE_SUPER_ADMIN)) {
            $this->addItem($menu, 'admin.nav.log', 'admin_log_index', 'file-text');

            /* Event Type */
            $eventType = $this->addItem($menu, 'admin.nav.event_type.title', 'admin_event_type_index', 'list');
            if (strpos($routeName, 'admin_event_type') === 0) {
                $eventType->setCurrent(true);
            }

            $ticketCategory = $this->addItem(
                $menu,
                'admin.nav.ticket_category.title',
                'admin_ticket_category_index',
                'ticket'
            );
            if (strpos($routeName, 'admin_ticket_category') === 0) {
                $ticketCategory->setCurrent(true);
            }

            /* Event */
            $event = $this->addItem($menu, 'admin.nav.event.title', 'admin_event_index', 'list');
            if (strpos($routeName, 'admin_event') === 0 && strpos($routeName, 'admin_event_type') !== 0) {
                $event->setCurrent(true);
            }

            /* Article */
            $article = $this->addItem($menu, 'admin.nav.article.title', 'admin_article_index', 'newspaper-o');
            if (strpos($routeName, 'admin_article') === 0) {
                $article->setCurrent(true);
            }
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
        /** @var Request $request */
        $request   = $this->getRequest();
        $routeName = $request->get('_route');
        $menu      = $factory->createItem('root');

        if ($this->getAuthorization()->isGranted(User::USER_ROLE_SUPER_ADMIN)) {
            $this->addItemIfRouteMatch('admin_log_index', $menu, 'admin_log_index', 'admin.nav.log', 'file-text');

            /* Event Type */
            $this->addItemIfRouteMatch('admin.nav.event_type.title', $menu, 'admin_event_type_index', 'list');
            if (strpos($routeName, 'admin_event_type_index') === 0) {
                $this->addItem($menu, 'admin.nav.event_type.index', 'admin_event_type_index', 'list');
                if (strpos($routeName, 'admin_event_type_add') === 0) {
                    $this->addItem($menu, 'admin.nav.event_type.create', 'admin_event_type_add', 'plus');
                }
                if (strpos($routeName, 'admin_event_type_edit') === 0) {
                    $eventType = $request->get('slug');
                    $this->addItem(
                        $menu,
                        'admin.nav.event_type.edit',
                        'admin_event_type_edit',
                        'pencil',
                        ['slug' => $eventType]
                    );
                }
            }

            /* Event */
            $this->addItemIfRouteMatch('admin.nav.event.title', $menu, 'admin_event_index', 'list');
            if (strpos($routeName, 'admin_event') === 0 && strpos($routeName, 'admin_event_type') !== 0) {
                $this->addItem($menu, 'admin.nav.event.index', 'admin_event_index', 'list');
                if (strpos($routeName, 'admin_event_add') === 0) {
                    $this->addItem($menu, 'admin.nav.event.create', 'admin_event_add', 'plus');
                }
                if (strpos($routeName, 'admin_event_edit') === 0) {
                    $event = $request->get('slug');
                    $this->addItem(
                        $menu,
                        'admin.nav.event.edit',
                        'admin_event_edit',
                        'pencil',
                        ['slug' => $event]
                    );
                }
            }

            /* Article */
            if (strpos($routeName, 'admin_article') === 0) {
                $this->addItem($menu, 'admin.nav.article.index', 'admin_article_index', 'newspaper-o');
                if (strpos($routeName, 'admin_article_add') === 0) {
                    $this->addItem($menu, 'admin.nav.article.create', 'admin_article_add', 'plus');
                }
                if (strpos($routeName, 'admin_article_edit') === 0) {
                    $article = $request->get('slug');
                    $this->addItem($menu, 'admin.nav.article.edit', 'admin_article_edit', 'pencil', ['slug' => $article]);
                }

                $this->addItemIfRouteMatch(
                    'admin.nav.ticket_category.title',
                    $menu,
                    'admin_ticket_category_index',
                    'ticket'
                );
            }

            /* Ticket Category */
            if (strpos($routeName, 'admin_ticket_category') === 0) {
                $this->addItem($menu, 'admin.nav.ticket_category.index', 'admin_ticket_category_index', 'list');
                if (strpos($routeName, 'admin_ticket_category_add') === 0) {
                    $this->addItem($menu, 'admin.nav.ticket_category.create', 'admin_ticket_category_add', 'plus');
                }
                if (strpos($routeName, 'admin_ticket_category_edit') === 0) {
                    $ticketCategory = $request->get('slug');
                    $this->addItem(
                        $menu,
                        'admin.nav.ticket_category.edit',
                        'admin_ticket_category_edit',
                        'pencil',
                        ['slug' => $ticketCategory]
                    );
                }
            }
        }

        return $menu;
    }

    /**
     * @param string        $prefix
     * @param ItemInterface $menuItem
     * @param string        $route
     * @param string        $label
     * @param string|null   $icon
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
}
