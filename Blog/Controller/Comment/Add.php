<?php
namespace Duud\Blog\Controller\Comment;
use \Magento\Framework\App\Action\Action;

class Add extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_commentFactory;

    protected $_resultJsonFactory;

    protected $_inlineTranslation;

    protected $_transportBuilder;

    protected $_scopeConfig;

    protected $_sendEmail;

    protected $_customerSession;

    protected $resultRedirect;

    function __construct(
        \Duud\Blog\Model\CommentFactory $commentFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Customer\Model\Session $customerSession,
        \Duud\Blog\Helper\SendEmail $sendEmail,
        \Magento\Framework\Controller\ResultFactory $result,
        \Magento\Framework\App\Action\Context $context
    )
    {
        $this->_commentFactory = $commentFactory;
        $this->_resultFactory = $context->getResultFactory();
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->_scopeConfig = $scopeConfig;
        $this->_sendEmail = $sendEmail;
        $this->_customerSession = $customerSession;
        $this->resultRedirect = $result;
        parent::__construct($context);
    }

    public function execute()
    {
        $error = false;
        $message = '';
        $postData = (array) $this->getRequest()->getPostValue();
        echo $postData;
        $jsonResultResponse = $this->_resultJsonFactory->create();
        if(!$postData)
        {
            $error = true;
            $message = "Your submission is not valid. Please try again!";

        }
        $this->_inlineTranslation->suspend();
        $postObject = new \Magento\Framework\DataObject();
        $postObject->setData($postData);

        if(!$this->_customerSession->isLoggedIn())
        {
            $error = true;
            $message = "You need log in to comment";

        }
        if(!$error)
        {
            $model = $this->_commentFactory->create();
            $model->addData([
                "content" => $postData['content'],
                "post_id" => $postData['post_id'],
                "author" => $postData['author'],
                "email" => $postData['email']
            ]);
            $model->save();
            $jsonResultResponse->setData([
                'result' => 'success',
                'message' => 'Thank you for your submission. Our Admins will review and approve shortly'
            ]);
            $userInfo = $this->_customerSession->getCustomerData();
            $name = $userInfo->getFirstName()." ".$userInfo->getLastName();
            $email = $userInfo->getEmail();
            echo $name;
            echo $email;
            $this->_sendEmail->approvalEmail($email, $name);
        } else {
            $jsonResultResponse->setData([
                'result' => 'error',
                'message' => $message
            ]);
        }

        return $jsonResultResponse;
    }

}