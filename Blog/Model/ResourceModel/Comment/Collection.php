<?php

namespace Duud\Blog\Model\ResourceModel\Comment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'comment_id';

    protected function _construct()
    {
        $this->_init('Duud\Blog\Model\Comment', 'Duud\Blog\Model\ResourceModel\Comment');
    }

}
