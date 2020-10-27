<?php

namespace Duud\Blog\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Framework\DataObject;

class NotificateComment extends DataObject implements SectionSourceInterface
{
    protected $_cmtCollectionFactory;
    protected $_customerSession;
    public function __construct(
        \Duud\Blog\Model\ResourceModel\Comment\CollectionFactory $cmtCollectionFactory,
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->_cmtCollectionFactory = $cmtCollectionFactory;
        $this->_customerSession = $customerSession;
    }
    public function getSectionData()
    {
        if($this->_customerSession->isLoggedIn())
        {
            $customer = $this->_customerSession->getCustomer();
            $user_id = $customer->getId();
            $cmtCheck = $this->_cmtCollectionFactory->create()
                ->addFieldToFilter('user_id', $user_id)
                ->addFieldToFilter('status', '0');
            $getCmtCount = $cmtCheck->count();
            if($getCmtCount > 0)
            {
                $cmtCount = ['getCmtCount' => "Comment no active: $getCmtCount"];
            }else $cmtCount = ['getCmtCount' => "Comment no active: 0"];
            return $cmtCount;
        }
        else
        {
            $cmtCount = ['getCmtCount' => ""];
            return $cmtCount;
        }
    }
}
