<?php

namespace Duud\Blog\Helper;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Config\ScopeConfigInterface;

class SendEmail extends AbstractHelper
{

	protected $_scopeConfig;
	protected $_transportBuilder;

	public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        TransportBuilder $transportBuilder
    )
    {
        $this->_scopeConfig = $scopeConfig;
        $this->_transportBuilder = $transportBuilder;
        parent::__construct($context);
    }
    public function reminderEmail($commentCount, $email, $name)
    {   
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $senderEmail = $this->_scopeConfig->getValue('trans_email/ident_general/email', $storeScope);
        $senderName = $this->_scopeConfig->getValue('trans_email/ident_general/name', $storeScope);
        $sender = [
            'name' => $senderName,
            'email' => $senderEmail
        ];
        $postObject = new \Magento\Framework\DataObject();
        $data = [];
        $data['name'] = $name;
        $data['comment_count'] = $commentCount;
        $data['subject'] = "ADMIN: $commentCount comment(s) waiting for approval";
        $postObject->setData($data);
        $transport = $this->_transportBuilder
            ->setTemplateIdentifier($this->_scopeConfig->getValue('blog/reminder/template', $storeScope))
            ->setTemplateOptions(
                [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                ]
            )
            ->setTemplateVars(['data' => $postObject])
            ->setFrom($sender)
            ->addTo($email)
            ->getTransport()
            ->sendMessage();
    }


}