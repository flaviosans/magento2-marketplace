<?php

namespace FlavioSans\Marketplace\Controller\Vendor;


use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;

class Profile extends Action
{
    protected PageFactory $resultPageFactory;
    protected LoggerInterface $logger;
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepositoryInterface;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CustomerRepositoryInterface $customerRepositoryInterface,
        LoggerInterface $logger
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
       return $this->resultPageFactory->create();
    }
}