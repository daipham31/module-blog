<?php
namespace Duud\Blog\Test\Unit\Controller\Index;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\Controller\Index\Index;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testExecute()
    {
        $objectManager = new ObjectManager($this);
        $controller = $objectManager->getObject(Index::class);
        $controller->execute();
    }
}
