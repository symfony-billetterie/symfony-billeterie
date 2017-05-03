<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gedmo\Uploadable\MimeType\MimeTypeGuesser;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class LoadArticleData
 */
class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            [
                'title'   => 'Concert Christophe Maé',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',

            ],
            [
                'title'   => 'Conférence astrophysique',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Meeting Francois Fillon',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Concert AC/DC',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Concert de JuL',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Concert Maya l\'abeille',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',

            ],
            [
                'title'   => 'Conférence avec le pape',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Meeting Angela Merkel',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Concert de Iam',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Conférence Symfony',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Théatre beauvais',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',

            ],
            [
                'title'   => 'Conférence écologique',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Meeting François Hollande',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Concert de Rock',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Concert de Beyoncé',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Concert de Diam\'s',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',

            ],
            [
                'title'   => 'Conférence économie mondiale',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Meeting Marine Lepen',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                AbstractFixture    </p>',
            ],
            [
                'title'   => 'Concert Shim',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
            [
                'title'   => 'Concert de Booba',
                'content' => '<p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis lacus quis eros bibendum, in fringilla nunc cursus. Pellentesque placerat elit sit amet massa molestie bibendum. Proin sit amet euismod lorem, non finibus mi. Maecenas id egestas nunc. Mauris porta libero eu tempor sollicitudin. Pellentesque eget ornare quam, eu ultrices felis. Nam a eleifend ex. Sed sagittis est a purus ullamcorper, vel molestie tellus laoreet. Praesent tristique, elit auctor aliquet sodales, nisi leo dapibus nisl, at porttitor lectus dui non dui. Vivamus sit amet velit quis lectus elementum viverra. Fusce tincidunt pellentesque ex, in ornare tellus feugiat id. Aliquam nec condimentum mi. Morbi pellentesque eu urna nec scelerisque. Suspendisse accumsan erat eu lectus ultricies pulvinar.
                    
                    Nulla facilisi. Donec vestibulum congue turpis a accumsan. Curabitur id dictum sem. Phasellus at mattis orci, eget pulvinar odio. Quisque placerat dolor nisi. Fusce sagittis mi quis nulla semper suscipit. Fusce eleifend ut augue sed tempus. Vestibulum ultrices mauris at justo luctus, et tristique eros sodales. Nullam ante nisl, malesuada ac ligula varius, dignissim blandit lectus. Aliquam hendrerit justo in leo pretium viverra. Praesent sit amet ipsum non enim consectetur lacinia sit amet eu risus. Vivamus ultricies sodales lacus ac porta. Ut vitae eleifend dolor. Sed et euismod est.
                    
                    Nullam purus metus, dapibus a tempus eu, venenatis et velit. Suspendisse purus neque, pretium et est sit amet, sodales pretium sapien. Duis nec arcu turpis. Aliquam vehicula tellus nunc, ac aliquet dui faucibus eget. Donec eu iaculis augue. Praesent tristique velit eu vestibulum vehicula. In suscipit pharetra elementum. In pellentesque dui quis felis vestibulum, non laoreet erat sollicitudin. Fusce accumsan mollis ex finibus convallis. Praesent mattis convallis odio sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in augue quis orci lobortis fringilla. Vivamus sed nulla laoreet, congue augue ac, interdum augue.
                    
                    Aliquam erat volutpat. Duis vestibulum a nunc eget vehicula. Donec et justo eu lectus bibendum dignissim ut nec orci. Integer pretium a sapien vel dictum. Curabitur interdum tortor magna, auctor tempus nibh ultrices ut. Aenean dolor massa, fringilla id interdum et, mollis vitae purus. Mauris tristique sapien ut massa tincidunt, ut scelerisque mauris porttitor. Praesent dictum massa leo.
                    
                    Donec erat enim, hendrerit at tellus in, vestibulum lacinia nulla. Donec in tellus elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Duis ornare augue quis pharetra sollicitudin. Nulla eget est massa. Sed enim libero, rutrum sed leo vitae, accumsan scelerisque risus.
                    </p>',
            ],
        ];

        foreach ($data as $item => $value) {
            $img = $item + 1;
            /** @var Article $article */
            $article = new Article();
            $article->setTitle($value['title']);
            $article->setContent($value['content']);
            copy($this->getRootDir().'/File/article/'.$img.'.jpg', $this->getRootDir().'/File/article/'.$img.'-copy.jpg');
            $uploadedPicture = $this->uploadFile($this->getRootDir().'/File/article/'.$img.'-copy.jpg');
            copy($this->getRootDir().'/File/article/pdf.pdf', $this->getRootDir().'/File/article/pdf-copy.pdf');
            $uploadedFile = $this->uploadFile($this->getRootDir().'/File/article/pdf-copy.pdf');
            chdir($this->getRootDir().'/../../../web');
            $article->setImage($uploadedPicture);
            $article->setFile($uploadedFile);
            $manager->persist($article);
            $this->setReference($value['title'], $article);
        }
        $manager->flush();
    }

    /**
     * @return string
     */
    private function getRootDir()
    {
        return $this->container->get('kernel')->getRootDir().'/../src/AppBundle/DataFixtures';
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

    /**
     * @return int
     */
    public function getOrder()
    {
        return 0;
    }
}
