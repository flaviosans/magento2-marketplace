<?php

namespace FlavioSans\Marketplace\Console\Command;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\State;

class CustomerSaveCommand extends Command
{
    public function __construct(
        private Customer $customer,
        private CustomerRepositoryInterface $customerRepository,
        private State $state
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('save:customers');
        $this->setDescription('Save existing customers');

        parent::configure();
    }

    /**
     * save all existing customers as normal customer
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode('frontend');
        $customers = $this->customer->getCollection();
        // $customers->getSelect()->limit(1);

        foreach ($customers as $customer) {
            $customer_id = $customer->getData('entity_id');
            $customer = $this->customerRepository->getById($customer_id);
            $customer->setCustomAttribute('is_vendor', 0);
            $customer->setCustomAttribute('approve_account', 1);
            try {
                $this->customerRepository->save($customer);
            } catch (Exception $e) {
                $this->writeErrorLog($e->getMessage());
            }
        }
        $output->writeln('All customers saved.');
    }
}