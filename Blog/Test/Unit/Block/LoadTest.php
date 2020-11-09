<?php
namespace Duud\Blog\Test\Unit\Block;

use Duud\Blog\Block\Comment\Load;
use Magento\Framework\View\Element\Template\Context;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

class LoadTest extends TestCase
{
    /**
     * @var Context|MockObject
     */
    private $contextMock;

    /**
     * @var HttpContext|MockObject
     */
    private $httpContextMock;

    /**
     * @var RequestInterface|MockObject
     */
    private $requestMock;

    /**
     * @var Load
     */
    private $load;


    /**
     * This function is called before the test runs.
     * Ideal for setting the values to variables or objects.
     */
    protected function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->requestMock = $this->createMock(RequestInterface::class);
        $this->httpContextMock = $this->createMock(HttpContext::class);

        $this->load = (new ObjectManagerHelper($this))->getObject(
            Load::class,
            [
                'context' => $this->contextMock,
                'httpContext' => $this->httpContextMock,
                'request' => $this->requestMock
            ]
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
        echo $result;
        $expectedResult = 2;
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetCustomerId()
    {
        $result = $this->load->getCustomerId();
        echo $result;
        $expectedResult = 2;
        $this->assertEquals($expectedResult, $result);
    }

}
