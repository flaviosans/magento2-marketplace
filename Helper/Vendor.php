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
     * Currently logged in customer
     *
     * @var CustomerInterface
     */
    protected $_currentCustomer;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @var Session
     */
    protected $_customerSession;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;


    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param Session $customerSession
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        Session $customerSession,
        StoreManagerInterface $storeManager,
        UrlInterface $urlBuilder
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_customerSession = $customerSession;
        $this->_storeManager = $storeManager;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context);
    }

    /**
    * Retrive customer login status
    * @return bool
    */
    public function _isCustomerLogIn()
    {
    	return $this->_customerSession->isLoggedIn();
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
        if(!$this->_currentCustomer && $this->_isCustomerLogIn())
        {
            $this->_currentCustomer = $this->_customerSession->getCustomerDataObject();
        }
        return $this->_currentCustomer;
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