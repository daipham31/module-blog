<?php

namespace Duud\Stickycart\Block\Product;

use Magento\Framework\View\Element\Template;


class Stickycart extends Template
{
	protected $_registry;

    protected $_stockItemRepository;

	public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
		array $data = []
	) {
		$this->_registry = $registry;
        $this->_stockItemRepository = $stockItemRepository;
		parent::__construct($context, $data);
	}

    
    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }

    public function getStockItem($productId)
    {
        return $this->_stockItemRepository->get($productId);
    } 
}