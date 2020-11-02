<?php

namespace Duud\Blog\Controller\Comment;

use \Magento\Framework\App\Action\Action;
use Duud\Blog\Api\Data\CommentInterface;
use Duud\Blog\Model\ResourceModel\Comment\Collection as CommentCollection;

class Load extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_resultJsonFactory;
    protected $_commentCollectionFactory;

    function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Duud\Blog\Model\ResourceModel\Comment\CollectionFactory $commentCollectionFactory,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->_resultFactory = $context->getResultFactory();
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_commentCollectionFactory = $commentCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $postData = (array)$this->getRequest()->getPostValue();
        $post_id = $postData['post_id'];
        $jsonResultResponse = $this->_resultJsonFactory->create();
        $comments = $this->_commentCollectionFactory
            ->create()
            ->addFilter('status', 0)
            ->addFilter('post_id', $post_id)
            ->toArray();
        $jsonResultResponse->setData($comments);
        return $jsonResultResponse;
    }
}
