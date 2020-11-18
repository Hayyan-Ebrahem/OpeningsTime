<?php

namespace Hayyan\OpeningsTime\Block;


class OpeningsTime extends \Magento\Framework\View\Element\Template
{
    // protected $_scopeConfig;
    protected $_localeLists;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,

        \Magento\Framework\Locale\TranslatedLists $localeLists,
        array $data = []

        )
    {        
        $this->_localeLists = $localeLists;
        parent::__construct($context, $data);


    }
    public function getWeekdays()
    {
        return $this->_localeLists->getOptionWeekdays(true, true);
    }  
}
?>