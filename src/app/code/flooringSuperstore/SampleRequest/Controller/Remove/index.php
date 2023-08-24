<?php
namespace flooringSuperstore\SampleRequest\Controller\Remove;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session;

class Index extends Action
{
    protected $jsonFactory;
    protected $session;

    public function __construct(Context $context, JsonFactory $jsonFactory, Session $session)
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->session = $session;
    }

    public function execute()
    {
        $productId = (int) $this->getRequest()->getParam('product_id');

        // Get current samples basket from session
        $sampleBasket = $this->session->getSampleBasket() ?: [];
    
        // Remove $productId from the samples basket
        $sampleBasket = array_diff($sampleBasket, [$productId]);
    
        // Update the samples basket in session
        $this->session->setSampleBasket($sampleBasket);
    
        $result = $this->jsonFactory->create();
        return $result->setData(['success' => true]);
    }
}

