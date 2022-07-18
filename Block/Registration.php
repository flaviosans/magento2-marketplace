<?php

namespace FlavioSans\Marketplace\Block;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Registration extends Template
{
    /**
     * Registration constructor.
     * @param Context $context
     * @param \FlavioSans\Marketplace\Model\Config\Source\IsVendorOptions $isVendorOptions
     * @param array $data
     */
    public function __construct(
        Context $context,
        \FlavioSans\Marketplace\Model\Config\Source\CustomerYesNoOptions $isVendorOptions,
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