<?php

namespace Duud\Blog\Block\Comment;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Add extends Template
{

    protected $_request;
    protected $_datetime;

    public function __construct(
        DateTime $datetime,
        Template\Context $context,
        RequestInterface $request,
        array $data = []
    )
    {
    	$this->_request = $request;
        $this->_datetime = $datetime;
    	parent::__construct($context, $data);
    }

    public function getPostId() {
        return $this->_request->getParam('post_id', false);
    }

    public function getCurrentDateTime() {
        return $this->_datetime->gmtDate();
    }
    
    public function getFormAction()
    {
        $baseUrl = $this->getBaseUrl();
        return $baseUrl.'blog/comment/add';
    }

    public function getAjaxUrl()
    {
        $baseUrl = $this->getBaseUrl();
        return $baseUrl.'blog/comment/load';
    }


}