<?php

namespace Duud\BlogSimple\Model\ResourceModel\Post;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Duud\BlogSimple\Model\Post', 'Duud\BlogSimple\Model\ResourceModel\Post');
    }
}