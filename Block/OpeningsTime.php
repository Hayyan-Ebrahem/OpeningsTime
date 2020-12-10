<?php

namespace MageGro\OpeningsTime\Block;


class OpeningsTime extends \Magento\Framework\View\Element\Template
{
    protected $helperData;
    protected $_localeLists;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \MageGro\OpeningsTime\Helper\Data $helperData,
        \Magento\Framework\Locale\ListsInterface $localeLists,
        array $data = []
    ) {
        $this->helperData = $helperData;
        $this->_localeLists = $localeLists;

        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getLocaleWeekdays()
    {
        return $this->_localeLists->getOptionWeekdays();
    }

  
    public function getConfigTimeFormat()
    {
        return $this->helperData->getTimeConfig();
    }

    public function getWeekdays()
    {
        $localeweekdays = array_column($this->getLocaleWeekdays(), 'label');
        $data = [];
        $weekdays = [];
        $days = $this->helperData->getDaysConfig();
        $timeFormat = $this->getConfigTimeFormat();

        foreach ($days as $day => $time) {
            foreach ($localeweekdays as  $label => $value) {
                if (strtok($day, '_') === $value) {
                    $data[$label][$value][] = $time;
                }
            }
        }
        ksort($data);
        foreach ($data as $day ) {
            foreach($day as $d => $t){
                $weekdays[] = ['day' => $d, 'time' => [
                    'openingtime' => str_replace(",", ":", substr($t[0], 0, -3)) .' ' . ($timeFormat == 12 ? str_replace(",", ":", $t[2]) : ''),
                    'closingtime' => str_replace(",", ":", substr($t[1], 0, -3)) .' ' . ($timeFormat == 12 ? str_replace(",", ":", $t[3]) : ''),
                ]];
            }
        }
        return $weekdays;

    }
}
