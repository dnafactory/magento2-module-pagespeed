<?php

namespace DNAFactory\PageSpeed\Management;

use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigManager implements \DNAFactory\PageSpeed\Api\ConfigManagerInterface
{
    const XML_BASE_NAME = 'dnafactory_pso';
    const XML_DEFER_REQUIREJS = 'js/defer_requirejs';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ){
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritDoc
     */
    public function isDeferRequireJsEnabled($scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        return $this->scopeConfig->isSetFlag(self::XML_BASE_NAME."/".self::XML_DEFER_REQUIREJS, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function getConfig($path, $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        return $this->scopeConfig->getValue(self::XML_BASE_NAME."/$path", $scopeType, $scopeCode);
    }
}
