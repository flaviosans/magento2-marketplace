<?php

namespace FlavioSans\Marketplace\Block;
use FlavioSans\Marketplace\Model\Config\Source\CustomerYesNoOptions;
use FlavioSans\Marketplace\Model\Config\Source\IsVendorOptions;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Registration extends Template
{
    /**
     * Registration constructor.
     * @param Context $context
     * @param IsVendorOptions $isVendorOptions
     * @param array $data
     */
    public function __construct(
        Context $context,
        CustomerYesNoOptions $isVendorOptions,
        array $data
    )
    {
        $this->isVendorOptions = $isVendorOptions;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     *
     */
    public function getIsVendorHTML()
    {
        //todo:: create is vendor dropdown html
    }
}