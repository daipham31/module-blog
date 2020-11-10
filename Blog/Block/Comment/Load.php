<?php

namespace Duud\Blog\Block\Comment;

use Duud\Blog\Api\Data\CommentInterface;
use Duud\Blog\Model\ResourceModel\Comment\Collection as CommentCollection;

class Load extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    protected $_commentCollectionFactory;
    protected $_request;
    protected $httpContext;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Duud\Blog\Model\ResourceModel\Comment\CollectionFactory $commentCollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\App\Http\Context $httpContext,
        array $data = []
    ) {
        $this->_commentCollectionFactory = $commentCollectionFactory;
        $this->_request = $request;
        $this->httpContext = $httpContext;
        parent::__construct($context, $data);
    }

    public function getPostId()
    {
        return $this->_request->getParam('post_id', false);
    }

    public function getCustomerIsLoggedIn()
    {
        return (bool)$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
    }

    public function getCustomerId()
    {
        return $this->httpContext->getValue('customer_id');
    }

    public function getCustomerName()
    {
        return $this->httpContext->getValue('customer_name');
    }

    public function getCustomerEmail()
    {
        return $this->httpContext->getValue('customer_email');
    }

    public function getTestId(){
        return 2;
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

    public function getCommentCount()
    {
        $user_id = $this->getCustomerId();
        $comments = $this->_commentCollectionFactory
            ->create()
            ->addFieldToFilter('user_id', $user_id);
        return $comments->count();
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        $identities = [];

        if (is_array($this->getComments()) || is_object($this->getComments()))
        {
            foreach ($this->getComments() as $item)
            {
                $identities = array_merge($identities, $item->getIdentities());
            }
        }
        return $identities;

    }
}
