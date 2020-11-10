<?php
namespace Duud\Blog\Test\Unit\Block;

use PHPUnit\Framework\TestCase;
class PostViewTest extends TestCase {


    /**
     * @var \Duud\Blog\Model\Post
     */
    protected $post;

    /**
     * @var \Duud\Blog\Block\PostView
     */
    protected $block;

    protected function setUp() :void
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->block = $objectManager->getObject('Duud\Blog\Block\PostView');
        $this->post = $objectManager->getObject('Duud\Blog\Model\Post');
        $reflection = new \ReflectionClass($this->post);
        $reflectionProperty = $reflection->getProperty('_idFieldName');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->post, 'post_id');
        $this->post->setId(1);
    }


    public function testGetIdentities()
    {

        $id = 1;
        $this->block->setPost($this->post);
        //var_dump($this->block->getIdentities());
        $this->assertEquals(
            [\Duud\Blog\Model\Post::CACHE_TAG . '_' . $id, \Duud\Blog\Model\Post::CACHE_TAG],
            $this->block->getIdentities()
        );
    }
}
