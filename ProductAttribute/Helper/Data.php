<?php

namespace Dev\ProductAttribute\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $checkoutSession;
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession
    )
    {
        $this->checkoutSession = $checkoutSession;
    }
    public function getAllItems()
    {
        return $this->checkoutSession->getQuote()->getAllItems();
    }
}