<?php

namespace AppBundle\Twig;

/**
 * Class HtmlSafeExtension
 */
class HtmlSafeExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('html', [$this, 'html'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param $html
     *
     * @return mixed
     */
    public function html($html)
    {
        return $html;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'twig_extension_html';
    }
}
