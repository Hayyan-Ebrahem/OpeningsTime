<?php

namespace Hayyan\OpeningsTime\Block;


class OpeningsTime extends \Magento\Framework\View\Element\Template
{
    // protected $_scopeConfig;
    protected $_scopeconfig;
    // protected $_localeLists;


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
        $days = $this->_scopeconfig->getValue('hayyan_store_openingstime_general/store_openings_values');
        // $magentoweekdays = $this->_localeLists->getOptionWeekdays(true, true);
        $pre = "_";

        foreach($days as $day => $time){
            $weekdays[$day] = [$time];

            if (substr( $day, 0, strlen($pre) ) === $pre )
            {
                unset($weekdays[$day]);

                $day = substr($day, strlen($pre));
                array_push($weekdays[$day],$time);

            }
        }
        foreach($weekdays as $day => $time){
            
            $data[] = ['day' => $day,'time' => [
                    'openingtime' => str_replace("," , ":" ,$time[0]),
                    'closingtime' => str_replace("," , ":" ,$time[1])]
                ];

        }
        

        return $data;
    }  
}
?>