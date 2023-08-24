<?php
namespace flooringSuperstore\SampleRequest\Controller\Add;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session;
use flooringSuperstore\SampleRequest\Model\SampleRequestFactory;

class Index extends Action
{
    protected $jsonFactory;
    protected $session;
    protected $sampleRequestFactory;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        Session $session,
        SampleRequestFactory $sampleRequestFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->session = $session;
        $this->sampleRequestFactory = $sampleRequestFactory;
    }

    public function execute()
    {
        $productId = (int) $this->getRequest()->getParam('product_id');
    
        // Get current samples basket from session
        $sampleBasket = $this->session->getSampleBasket() ?: [];
    
        // Add $productId to the samples basket
        $sampleBasket[] = $productId;
    
        // Update the samples basket in session
        $this->session->setSampleBasket($sampleBasket);
    
        $result = $this->jsonFactory->create();
        return $result->setData(['success' => true]);
    }
}

