<?php
namespace Duud\Blog\Test\Unit\Block;

use Duud\Blog\Block\Comment\Load;
use Magento\Framework\View\Element\Template\Context;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Duud\Blog\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class LoadTest extends TestCase
{
    /**
     * @var Context|MockObject
     */
    private $contextMock;

    /**
     * @var JsonFactory|MockObject
     */
    private $resultJsonFactoryMock;

    /**
     * @var HttpContext|MockObject
     */
    private $httpContextMock;

    /**
     * @var RequestInterface|MockObject
     */
    private $requestMock;

    /**
     * @var CollectionFactory|MockObject
     */
    private $collectionFactoryMock;

    /**
     * This function is called before the test runs.
     * Ideal for setting the values to variables or objects.
     */
    protected function setUp(): void
    {
        $contextMock = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();
        $requestMock = $this->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $requestMock->method('getParam')
            ->willReturn(false);

        $httpContextMock = $this->getMockBuilder(HttpContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $collectionFactoryMock = $this->getMockBuilder(CollectionFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $resultJsonFactoryMock = $this->getMockBuilder(JsonFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->load = new Load(
            $contextMock,
            $collectionFactoryMock,
            $requestMock,
            $httpContextMock
        );

    }

    /**
     * This function is called after the test runs.
     * Ideal for setting the values to variables or objects.
     */
    public function tearDown(): void
    {
    }

    /**
     * this function tests the result of the addition of two numbers
     *
     */
    public function testGetTestId()
    {
        $result = $this->load->getTestId();
        $expectedResult = 2;
        $this->assertEquals($expectedResult, $result);
    }

    public function testLoadInstance()
    {
        $this->assertInstanceOf(Load::class,$this->load);
    }

    public function testImplementsIdentityInterface()
    {
        $this->assertInstanceOf(IdentityInterface::class,$this->load);
    }


}
