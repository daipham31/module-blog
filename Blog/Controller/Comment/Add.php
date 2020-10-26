<?php

namespace Duud\Blog\Controller\Comment;

use Magento\Framework\App\Action\Action;

class Add extends Action
{
    protected $resultJsonFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        JsonFactory $resultJsonFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $error = false;
        $message = '';
        $post = $this->getRequest()->getPostValue();

        if(!$post)
        {
            $error = true;
            $message = "Your submission is not valid. Please try again!";
        }

        $this->_inlineTranslation->suspend();
        $postObject = new \Magento\Framework\DataObject();
        $postObject->setData($post);

        if(!\Zend_Validate::is(trim($postData['email']), 'NotEmpty'))
        {
            $error = true;
            $message = "Email can not be empty!";
        }

        if(!\Zend_Validate::is(trim($postData['content']), 'NotEmpty'))
        {
            $error = true;
            $message = "Content can not be empty!";
        }

        $jsonResultResponse = $this->resultJsonFactory->create();

        if(!$error)
        {
            $jsonResultResponse->setData([
                'result' => 'success',
                'message' => 'Thank you for your submission. Our Admins will review and approve shortly'
            ]);

        } else {
            $jsonResultResponse->setData([
                'result' => 'error',
                'message' => $message
            ]);    
        }

        return $jsonResultResponse;

    }
}