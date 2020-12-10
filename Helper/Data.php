<?php

namespace MageGro\OpeningsTime\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $_scopeconfig;

    /**
     * @var \Magento\Framework\App\Http\Context
     */
    private $httpContext;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeconfig

    ) {
        $this->_scopeconfig = $scopeconfig;

        parent::__construct($context);
        $this->httpContext = $httpContext;
    }

    public function getTimeConfig()
    {
        $timeFormat = $this->_scopeconfig->getValue('magegro_store_openingstime_general/openings_time_settings/time_format', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $timeFormat = substr($timeFormat,0,2);
        return $timeFormat;
    }

    public function getDaysConfig()
    {
        $days = $this->_scopeconfig->getValue('magegro_store_openingstime_general/store_openings_values', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $days;
    }


}
