<?php

namespace Hayyan\OpeningsTime\Model\System\Config\Backend;

class SaveFields extends \Magento\Framework\App\Config\Value
{
    protected $_config;

    protected $cacheTypeList;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $config
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\App\Config\ValueFactory $configValueFactory
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_config = $config;
        $this->cacheTypeList = $cacheTypeList;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * Prepare data before save
     *
     * @return $this
     */
    public function beforeSave()
    {
        $value = $this->getValue();
        $timeFormat = $this->_config->getValue('hayyan_store_openingstime_general/openings_time_settings/time_format', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $timeFormat = substr($timeFormat, 0, 2);
        // $result = [];
        // foreach ($value as $data) {
        //     echo $data;
        // }
        $time = implode( ':', $value );

        if ($timeFormat == 12) {

            $field = date("g:i A", strtotime($time));

            $this->setValue(serialize($field)); // serialize your data

           
        } else {
                $field = date("h:i A", strtotime($time));
                $this->setValue(serialize($field)); // serialize your data

            }
        
        return $this;

    }
}
