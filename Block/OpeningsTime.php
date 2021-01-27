<?php

namespace Magegro\OpeningsTime\Block;


class OpeningsTime extends \Magento\Framework\View\Element\Template
{
    protected $helperData;
    protected $_localeLists;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magegro\OpeningsTime\Helper\Data $helperData,
        \Magento\Framework\Locale\ListsInterface $localeLists,
        array $data = []
    ) {
        $this->helperData = $helperData;
        $this->_localeLists = $localeLists;

        parent::__construct($context, $data);
    }


    public function getFirstDay()
    {
        return $this->helperData->getFirstDay();
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

    public function resolveTime($time)
    {
        $timeFormat = $this->getConfigTimeFormat();
        if ($timeFormat == '12') {
            return date('g:i A', strtotime($time));
        }
        return $time;
    }

    public function getWeekDaysTime()
    {
        $localeweekdays = array_column($this->getLocaleWeekdays(), 'label');
        $data = [];
        $weekdays = [];
        $days = $this->helperData->getDaysConfig();

        foreach ($days as $day => $time) {
            $values = explode("_", $day);

            foreach ($localeweekdays as  $label => $value) {

                if ($values[0] == $value) {
                    $data[$label][$values[0]][$values[1]] =  $this->resolveTime($time);
                }
            }
        }
        ksort($data);
        foreach ($data as $day) {
            foreach ($day as $d => $t) {
                $weekdays[] = ['day' => $d, 'time' => $t];
            }
        }
        
        return $weekdays;
    }
}
