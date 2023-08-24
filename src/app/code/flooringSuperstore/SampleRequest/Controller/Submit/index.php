<?php
namespace flooringSuperstore\SampleRequest\Controller\Submit;

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
        // Get current samples basket from session
        $sampleBasket = $this->session->getSampleBasket() ?: [];

        // Store $sampleBasket in the database
        foreach ($sampleBasket as $productId) {
            // Create a new SampleRequest instance
            $sampleRequest = $this->sampleRequestFactory->create();
            $sampleRequest->setProductId($productId);
            $sampleRequest->save(); // Save the record to the database
        }

        // Clear the samples basket in session
        $this->session->setSampleBasket([]);

        $result = $this->jsonFactory->create();
        return $result->setData(['success' => true]);
    }
}

