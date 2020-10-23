<?php

namespace Duud\Blog\Controller\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;

class Add extends Action
{
    protected $resultPageFactory;
    protected $resultJsonFactory;
    protected $_inlineTranslation;
    protected $_transportBuilder;
    protected $storeManager;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {
        // echo "dssds";die();
        $error = false;
        $message = '';
        $postData = (array) $this->getRequest()->getPostValue();

        if(!$postData)
        {
            $error = true;
            $message = "Your submission is not valid. Please try again!";
        }

        $this->_inlineTranslation->suspend();
        $postObject = new \Magento\Framework\DataObject();
        $postObject->setData($postData);

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
            $author        = 'Dai Pham';
            $postData['author'] = $author;
            $email = $postData['email'];
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            
            $transport = $this->_transportBuilder->setTemplateIdentifier(
                $this->scopeConfig->getValue(
                        'blog/general/template',
                        $storeScope
                    )
                )->setTemplateOptions(
                        [
                            'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                            'store' => $this->storeManager->getStore()->getStoreId(),
                        ]
                    )->setTemplateVars(
                        [
                            'name' => $postData['author'],
                        ]
                    )->setFrom(
                        [
                           "email" => 'daipham31@outlook.com',
                           'name' => $postData['author']
                        ]
                    )->addTo(
                        $email
                    )->getTransport()->sendMessage();


            $comment = $this->_objectManager->create("Duud\Blog\Model\Comment");
            $comment->addData($postData)->save();
            $this->messageManager->addSuccessMessage(__("Send Comment Success !"));
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

    public function senderEmail($type = null, $storeId = null)
    {
        $sender ['email'] = $this->scopeConfig->getValue(
                                self::SENDER_EMAIL,
                                ScopeInterface::SCOPE_STORE,
                                $storeId
                            );
        $sender['name'] = 'admin';

        return $sender;
    }
}