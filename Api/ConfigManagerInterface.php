<?php

namespace DNAFactory\PageSpeed\Api;

use Magento\Framework\App\Config\ScopeConfigInterface;

interface ConfigManagerInterface
{
    /**
     * @param string $scopeType
     * @param null|string $scopeCode
     * @return bool
     */
    public function isDeferRequireJsEnabled($scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null);

    /**
     * @param string $path
     * @param string $scopeType
     * @param null|string $scopeCode
     * @return mixed
     */
    public function getConfig($path, $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null);
}
