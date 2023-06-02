<?php
 
namespace Dev\ProductAttribute\Plugin\Checkout\Controller;
 
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\UrlFactory;
use Magento\Checkout\Controller\Index\Index;
 
class Restrict 
{
    private $urlModel;
    private $resultRedirectFactory;
    private $messageManager;
    private $helper;
 
    public function __construct(
        UrlFactory $urlFactory,
        RedirectFactory $redirectFactory,
        ManagerInterface $messageManager,
        \Dev\ProductAttribute\Helper\Data $helper
    ) {
    
        $this->urlModel = $urlFactory;
        $this->resultRedirectFactory = $redirectFactory;
        $this->messageManager = $messageManager;
        $this->helper = $helper;
    }
 
    public function aroundExecute(
        Index $subject,
        \Closure $proceed
    ){
    
        $this->urlModel = $this->urlModel->create();
        
            $items = $this->helper->getAllItems();

            $preorder[]='';
            $nonpreorder[]='';

            foreach($items as $item)
    {
        if($item->getProduct()->getData('pre_order'))
        {
            $preorder[]=$item->getProduct()->getData('pre_order');
        }
        else
        {
            $nonpreorder[]=$item->getProduct()->getData('');
        }
    }

    if(count($preorder) > 1 && count($nonpreorder) > 1)
    {
        $defaultUrl = $this->urlModel->getUrl('checkout/cart');
         $resultRedirect = $this->resultRedirectFactory->create();
         return $resultRedirect->setUrl($defaultUrl);
            
          
    }
        return $proceed();
  }
}