<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gedmo\Uploadable\MimeType\MimeTypeGuesser;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class LoadArticleData
 */
class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            [
                'title'   => 'Concert Christophe Maé',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, asperiores cum distinctio dolore dolorum harum in inventore ipsum minus natus odit optio placeat quis tempore temporibus tenetur vitae voluptate voluptatum.</p>',

            ],
            [
                'title'   => 'Conférence astrophysique',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad commodi consequatur eius esse eveniet ex harum ipsam laborum modi molestias mollitia nam, numquam optio provident quia reiciendis similique unde velit!</p>',

            ],
            [
                'title'   => 'Meeting Francois Fillon',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi, cupiditate debitis dolor error, eveniet excepturi, exercitationem in ipsam laborum maiores nihil quod repellendus sapiente temporibus unde vero vitae voluptatem?</p>',

            ],
            [
                'title'   => 'Concert AC/DC',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam beatae culpa cum dolorum, incidunt iste minima molestiae nam necessitatibus, non odit similique suscipit voluptas. Corporis enim fugit quasi sequi sit.</p>',

            ],
            [
                'title'   => 'Concert de JuL',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab dignissimos ipsam minima nobis nostrum quasi quisquam tempora. Ducimus expedita maxime nostrum quas sed ullam? Autem debitis fugiat magnam nesciunt repellendus?</p>',

            ],
        ];

        foreach ($data as $item => $value) {
            $img = $item+1;
            /** @var Article $article */
            $article = new Article();
            $article->setTitle($value['title']);
            $article->setContent($value['content']);
            copy(__DIR__.'/../File/article/'.$img.'.jpg', __DIR__.'/../File/article/'.$img.'-copy.jpg');
            $uploadedPicture = $this->uploadFile(__DIR__.'/../File/article/'.$img.'-copy.jpg');
            copy(__DIR__.'/../File/article/pdf.pdf', __DIR__.'/../File/article/pdf-copy.pdf');
            $uploadedFile = $this->uploadFile(__DIR__.'/../File/article/pdf-copy.pdf');
            chdir(__DIR__.'/../../../../web');
            $article->setImage($uploadedPicture);
            $article->setFile($uploadedFile);
            $manager->persist($article);
            $this->setReference($value['title'], $article);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 0;
    }

    /**
     * @param $path
     *
     * @return UploadedFile
     */
    private function uploadFile($path)
    {
        $mimeTypeGuesser = new MimeTypeGuesser();
        if (!$src = realpath($path)) {
            throw new \InvalidArgumentException(sprintf('File "%s" does not exist', $path));
        }

        return new UploadedFile($src, basename($path), $mimeTypeGuesser->guess($src), filesize($src), null, true);
    }
}
