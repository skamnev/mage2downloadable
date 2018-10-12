<?php
/**
 * Copyright © SkExt. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace SkExt\DownloadableProduct\Block\Customer\Products;

/**
 * SkExt Override Block to display downloadable links bought by customer
 *
 */
class ListProducts extends \Magento\Downloadable\Block\Customer\Products\ListProducts
{
    /**
     * @var \Magento\Framework\App\ObjectManager
     */
    protected $objectManager;

    /**
     * ListProducts constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
     * @param \Magento\Downloadable\Model\ResourceModel\Link\Purchased\CollectionFactory $linksFactory
     * @param \Magento\Downloadable\Model\ResourceModel\Link\Purchased\Item\CollectionFactory $itemsFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        \Magento\Downloadable\Model\ResourceModel\Link\Purchased\CollectionFactory $linksFactory,
        \Magento\Downloadable\Model\ResourceModel\Link\Purchased\Item\CollectionFactory $itemsFactory,
        array $data = []
    ) {
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        parent::__construct($context, $currentCustomer, $linksFactory, $itemsFactory, $data);
    }

    public function getIsVisible($item) {
        try {
            $product = $this->objectManager->create('Magento\Catalog\Model\Product')->load($item->getProductId());

            return $product->getIsVisibleProduct();
        } catch (Exception $e) {
            /** TODO process/log exception */
        }

        /** Return true by default in case issues happened */
        return true;
    }
}
