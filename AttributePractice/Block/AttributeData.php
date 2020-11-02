<?php

namespace Duud\AttributePractice\Block;

class AttributeData extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\ObjectManager $objectManager,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $address,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getAttributeData()
    {
        $addressInformation = $objectManager->getInstance()->create($address);
        $extAttributes = $addressInformation->getExtensionAttributes();
        $selectedShipping = $extAttributes->getCustomShippingCharge();
    }

}