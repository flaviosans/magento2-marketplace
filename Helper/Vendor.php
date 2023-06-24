<?php

namespace FlavioSans\Marketplace\Helper;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Vendor extends AbstractHelper
{
    /**
     * Constructor.
     *
     * @param Context $context
     * @param Registry $coreRegistry
     * @param Session $customerSession
     * @param StoreManagerInterface $storeManager
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        private Context $context,
        private Registry $coreRegistry,
        private Session $customerSession,
        private StoreManagerInterface $storeManager,
        private UrlInterface $urlBuilder
    ) {

        parent::__construct($context);
    }

    /**
    * Retrive customer login status
    * @return bool
    */
    public function _isCustomerLogIn()
    {
    	return $this->customerSession->isLoggedIn();
    }

    /** Retrive logged in customer
     * @return CustomerInterface
     */
    protected function _getCurrentCustomer()
    {
        return $this->getCustomer();
    }

    /**
     * Retrieve current customer
     *
     * @return CustomerInterface|null
     */
    public function getCustomer()
    {
        if(!$this->currentCustomer && $this->_isCustomerLogIn())
        {
            $this->currentCustomer = $this->customerSession->getCustomerDataObject();
        }
        return $this->currentCustomer;
    }

    /**
     *  Check is vendor section allowed in sidebar
     * @return bool
     */
    public function isVendorInfoAllowedInSidebar()
    {
        if($this->isAVendorAndAccountApproved()){
            return true;
        }
        return false;
    }

    /**
     * Check if customer is a vendor and account is approved
     */
    public function isAVendorAndAccountApproved()
    {
        $this->_currentCustomer = $this->getCustomer();
        $isVendor = $this->_currentCustomer->getCustomAttribute('is_vendor')->getValue();
        $isApprovedAccount = $this->_currentCustomer->getCustomAttribute('approve_account')->getValue();

        if($isVendor && $isApprovedAccount)
        {
            return true;
        }
        return false;
    }

    /**
     *  Return vendor profile url
     * @return mixed
     */
    public function getVendorProfileUrl()
    {
        return $this->urlBuilder->getUrl('marketplace/vendor/profile');
    }
}