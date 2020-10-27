<?php

namespace Duud\Blog\Block\Comment;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Add extends Template
{

    protected $_request;
    protected $_datetime;
    protected $_customerSession;

    public function __construct(
        DateTime $datetime,
        Template\Context $context,
        RequestInterface $request,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    )
    {
    	$this->_request = $request;
        $this->_datetime = $datetime;
    	parent::__construct($context, $data);
    }
    public function getFormAction()
	{
		return 'blog/comment/add';
	}

	public function getAjaxUrl()
	{
		return '/blog/comment/load';
	}

	public function getPostID()
	{
		return $this->_request->getParam('post_id', false);
    }
    public function isLoggedIn()
	{
		return $this->_customerSession->isLoggedIn();
	}

}