<?php

namespace FlavioSans\Marketplace\Setup;


use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

class Uninstall implements UninstallInterface
{
    protected EavSetupFactory $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }



    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create();

        /**
         * product attributes
         */
        $entityTypeId = 4; // Find these in the eav_entity_type table
        $eavSetup->removeAttribute($entityTypeId, 'vendor_id');

        /**
         * customer attributes
         */
        $entityTypeId = 1;
        $eavSetup->removeAttribute($entityTypeId, 'is_vendor');
        $eavSetup->removeAttribute($entityTypeId, 'approve_account');
        $setup->endSetup();

    }

}