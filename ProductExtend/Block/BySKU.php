<?php

namespace Duud\ProductExtend\Block;

class BySKU extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
    protected $_catalogSession;
    private $productRepository;
    protected $_product;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\Session $catalogSession,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_catalogSession = $catalogSession;
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    public function loadMyProduct()
    {
        return $this->productRepository->get('MT12');
    }

    public function getFactorySku()
    {
        $product = $this->productFactory->create();
        $productBySku = $product->loadByAttribute('sku', 'MT12');
        return $productBySku;
    }

    public function getCatalogSession()
    {
        return $this->_catalogSession;
    }

    public function getRegistry()
    {
        return $this->_registry->registry('custom_var');
    }
}