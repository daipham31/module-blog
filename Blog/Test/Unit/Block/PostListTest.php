<?php

namespace Duud\Blog\Test\Unit\Block;

use Magento\Framework\DataObject\IdentityInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Magento\Framework\View\Element\Template\Context;
use Duud\Blog\Model\ResourceModel\Post\CollectionFactory;
use Duud\Blog\Block\PostList;

class PostListTest extends TestCase{

    /**
     * @var Context|MockObject
     */
    private $contextMock;

    /**
     * @var CollectionFactory|MockObject
     */
    private $collectionFactoryMock;

    public function setUp() :void
    {
        $contextMock = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();

        $collectionFactoryMock = $this->getMockBuilder(CollectionFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postlist = new PostList(
            $contextMock,
            $collectionFactoryMock
        );
    }

    /**
     * This function is called after the test runs.
     * Ideal for setting the values to variables or objects.
     */
    public function tearDown(): void
    {
    }

    public function testPostListInstance()
    {
        $this->assertInstanceOf(PostList::class,$this->postlist);
    }

    public function testImplementsIdentityInterface()
    {
        $this->assertInstanceOf(IdentityInterface::class,$this->postlist);
    }

}
?>
