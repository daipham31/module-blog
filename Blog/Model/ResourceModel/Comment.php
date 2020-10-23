<?php

namespace Duud\Blog\Model\ResourceModel;

class Comment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('duud_blog_comment', 'comment_id');
    }

}