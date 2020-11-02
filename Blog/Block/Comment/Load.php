<?php

namespace Duud\Blog\Block\Comment;

use Duud\Blog\Api\Data\CommentInterface;
use Duud\Blog\Model\ResourceModel\Comment\Collection as CommentCollection;

class Load extends \Magento\Framework\View\Element\Template
{
    protected $_commentCollectionFactory;
    protected $_request;
    protected $_resultJsonFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Duud\Blog\Model\ResourceModel\Comment\CollectionFactory $commentCollectionFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\App\RequestInterface $request,
        array $data = []
    ) {
        $this->_commentCollectionFactory = $commentCollectionFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_request = $request;
        parent::__construct($context, $data);
    }

    public function getPostId()
    {
        return $this->_request->getParam('post_id', false);
    }

    public function getComments()
    {
        $post_id = $this->getPostId();
        $page = $this->_request->getParam('page', false);
        if (!$this->hasData("cmt")) {
            $comments = $this->_commentCollectionFactory
                ->create()
                ->addFieldToFilter('post_id', $post_id)
                ->addFieldToFilter('status', 2)
                ->addOrder(
                    CommentInterface::CREATION_TIME,
                    CommentCollection::SORT_ORDER_DESC
                )
                ->setCurPage($page);
            $this->setData("cmt", $comments);
        }
        return $this->getData("cmt");
    }
}
