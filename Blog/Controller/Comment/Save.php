<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Duud\Blog\Controller\Comment;

use Magento\Framework\App\Action\Context;
use Duud\Blog\Model\CommentFactory;

class Save extends \Magento\Framework\App\Action\Action
{

    protected $comment;

    public function __construct(
        \Magento\Framework\App\Request\Http $request,
        Context $context,
        CommentFactory $comment
    ) {
        $this->comment = $comment;
        $this->request = $request;
        parent::__construct($context);
    }

    public function execute()
    {
        
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if($customerSession->isLoggedIn())
        {
        $data = $this->request->getParams();
        $comment = $this->comment->create();
        $comment->setData($data);
        if ($comment->save()) {
            $this->messageManager->addSuccessMessage(__('You saved comment'));
        } else {
            $this->messageManager->addErrorMessage(__('Comment was not saved.'));
        }
        $response = $this->resultFactory
            ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
            ->setData($comment->getData());
        return $response;  

        }else{
            $comment->delete();
        }
             
        
    }
}