<?php

namespace FlavioSans\Marketplace\Test\Integration;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\App\DeploymentConfig\Reader;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;
use PHPUnit_Framework_TestCase;

class ModuleConfigTest extends PHPUnit_Framework_TestCase
{
    private string $subjectModuleName;

    /**
     * @var $objectManager ObjectManager
     */
    private \Magento\Framework\App\ObjectManager|ObjectManager $objectManager;

    protected function setUp()
    {
        $this->subjectModuleName = 'FlavioSans_Marketplace';
        $this->objectManager = ObjectManager::getInstance();
    }

    public function testTheModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();
        $this->assertArrayHasKey('FlavioSans_Marketplace', $registrar->getPaths(ComponentRegistrar::MODULE));
    }

    public function testTheModuleIsConfiguredInTheTestEnvironment()
    {
        /**
         * @var $moduleList ModuleList
         */
        $moduleList = $this->objectManager->create(ModuleList::class);
        $this->assertTrue($moduleList->has($this->subjectModuleName));
    }

    public function testTheModuleIsConfiguredInRealEnvironment()
    {
        /**
         * @var $objectManager ObjectManager
         */
        $this->objectManager = ObjectManager::getInstance();

        // The tests by default point to the wrong config directory for this test.
        $directoryList = $this->objectManager->create(
            DirectoryList::class,
            ['root' => BP]
        );
        $deploymentConfigReader = $this->objectManager->create(
            Reader::class,
            ['dirList' => $directoryList]
        );
        $deploymentConfig = $this->objectManager->create(
            DeploymentConfig::class,
            ['reader' => $deploymentConfigReader]
        );

        /** @var $moduleList ModuleList */
        $moduleList = $this->objectManager->create(
            ModuleList::class,
            ['config' => $deploymentConfig]
        );
        $this->assertTrue($moduleList->has($this->subjectModuleName));
    }
}
