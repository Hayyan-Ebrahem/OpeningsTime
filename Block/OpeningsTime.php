<?php

namespace Hayyan\OpeningsTime\Block;


class OpeningsTime extends \Magento\Framework\View\Element\Template
{
    // protected $_scopeConfig;
    protected $_storeInfo;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\Information $storeInfo,
        array $data = []
    )
    {        
        $this->_storeInfo = $storeInfo;
        parent::__construct($context, $data);
    }
    public function getStoreOpeningsTime()
    {
        return $this->_storeInfo->getStoreInformationObject($this->_storeManager->getStore())->getHours();
    }  
}
?>