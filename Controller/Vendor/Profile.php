<?php

namespace FlavioSans\Marketplace\Controller\Vendor;


use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;

class Profile extends Action
{
    public function __construct(
        private Context $context,
        private PageFactory $resultPageFactory,
        private CustomerRepositoryInterface $customerRepositoryInterface,
        private LoggerInterface $logger
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
       return $this->resultPageFactory->create();
    }
}