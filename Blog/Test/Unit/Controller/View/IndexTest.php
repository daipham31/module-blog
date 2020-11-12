<?php
namespace Duud\Blog\Test\Unit\Controller\View;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Duud\Blog\Controller\View\Index;
use Magento\Framework\View\Element\Template\Context;
use PHPUnit\Framework\TestCase;
use \Magento\Framework\App\Action\Action;

class IndexTest extends TestCase
{
    public function testExecute()
    {
        $objectManager = new ObjectManager($this);
        $controller = $objectManager->getObject(Index::class);

        $contextMock = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();

        $actionMock = $this->getMockBuilder(Action::class)
            ->disableOriginalConstructor()
            ->getMock();
        $actionMock->expects($this->once())
            ->method('prepareResultPost');


        $controller->execute();
    }
}
