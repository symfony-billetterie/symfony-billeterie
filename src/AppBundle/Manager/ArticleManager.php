<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ArticleManager
 */
class ArticleManager
{
    private $request;
    private $knpPaginator;
    private $em;

    /**
     * ArticleManager constructor.
     *
     * @param RequestStack  $request
     * @param Paginator     $knpPaginator
     * @param EntityManager $em
     */
    public function __construct(RequestStack $request, Paginator $knpPaginator, EntityManager $em)
    {
        $this->request      = $request;
        $this->knpPaginator = $knpPaginator;
        $this->em           = $em;
    }

    /**
     * @return Article[]|array|PaginatorInterface
     */
    public function listArticle()
    {
        $articles = $this->em->getRepository('AppBundle:Article')->findBy([], ['id' => 'DESC']);

        /** @var PaginatorInterface $articles */
        $articles = $this->knpPaginator->paginate(
            $articles,
            $this->request->getCurrentRequest()->query->getInt('page', 1),
            10
        );

        return $articles;
    }
}
