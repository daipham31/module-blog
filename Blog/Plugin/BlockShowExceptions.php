<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Duud\Blog\Plugin;


class BlockShowExceptions
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    /**
     * AddCustomerStatusHandle constructor.
     *
     * @param \Magento\Customer\Model\Session $session
     */
    public function __construct(
        \Magento\Customer\Model\Session $session
    ) {
        $this->customerSession = $session;
    }


    public function afterAddHandle(
        \Magento\Framework\View\Result\Layout $subject,
        \Magento\Framework\View\Result\Layout $result,
        $handleName
    ){
        if ($handleName == 'blog_index_index') {
            $availableHandles = $result->getLayout()->getUpdate()->getHandles();
            if ($this->customerSession->getCustomerId() &&
                !in_array('customer_logged_in', $availableHandles)
            ) {
                $result->addHandle('customer_logged_in');
            } elseif (!in_array('customer_logged_out', $availableHandles)) {
                $result->addHandle('customer_logged_out');
            }
        }

        return $result;

    }

}
