<?php
namespace Duud\AttributePractice\Block;
class AttributeData extends \Magento\Framework\View\Element\Template
{
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
   	}

    public function getAttributeData()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $addressInformation = $objectManager->create('Magento\Checkout\Api\Data\ShippingInformationInterface');
        $extAttributes = $addressInformation->getExtensionAttributes();
        $selectedShipping = $extAttributes->getCustomShippingCharge();
    }

}