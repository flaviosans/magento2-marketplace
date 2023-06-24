<?php

namespace FlavioSans\Marketplace\Block\Vendor;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;


class Profile extends Template
{

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        private Context $context,
        private array $data
    ) {
        parent::__construct($context, $data);
    }

    public function getAboutVendor()
    {
        //@todo:: return about vendor
        return '';
    }

    public function getSaveProfileUrl()
    {
        return $this->getUrl('marketplace/vendor/save');
    }
}