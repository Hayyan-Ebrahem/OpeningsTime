<?php

namespace Hayyan\OpeningsTime\Block;


class OpeningsTime extends \Magento\Framework\View\Element\Template
{
    // protected $_scopeConfig;
    protected $_scopeconfig;
    protected $_localeLists;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeconfig,
        // \Magento\Framework\Locale\TranslatedLists $localeLists,
        array $data = []
    )
    {        
        $this->_scopeconfig = $scopeconfig;
        // $this->_localeLists = $localeLists;

        parent::__construct($context, $data);
    }
    public function getWeekdays()
    {
        $weekdays = [];
        $days = $this->_scopeconfig->getValue('hayyan_store_openingstime/store_openings_val');
        // $magentoweekdays = $this->_localeLists->getOptionWeekdays(true, true);

        foreach($days as $day => $time){
            array_push($weekdays,["day" => $day, "time" => $time]);

        }

        return $weekdays;
    }  
}
?>