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

    public function resolveTime($data)
    {
        if($data === '0' || $data === '1' ){
            return strval($data);
        }
        $timeFormat = $this->getConfigTimeFormat();
        if ($timeFormat == '12') {
            return date('g:i A', strtotime($data));
        }
        return $data;
    }

    public function getWeekDaysTime()
    {
        $localeweekdays = array_column($this->getLocaleWeekdays(), 'label');
        $source = [];
        $days = $this->helperData->getDaysConfig();


        foreach ($days as $day => $data) {
            $values = explode("_", $day);
            $daynameindex = array_search($values[0], $localeweekdays);
            $source[$daynameindex][$values[0]][$values[1]] =  $this->resolveTime($data);
        }

        $FirstDayIndex = $this->helperData->getFirstDay();

        $result = array_merge(array_slice($source, $FirstDayIndex, null, true), array_slice($source, 0, $FirstDayIndex, true));

        foreach ($result as $index => $day) {
            if($day[key($day)]['status'] === '0'){ continue; }
            $daynameindex = array_search(key($day), $localeweekdays);
            $weekdays[$index] = ['dayindex' => $daynameindex, 'day' => $localeweekdays[$daynameindex], 'open' => $day[key($day)]['open'], 'close'  => $day[key($day)]['close']];
        }

        return array_values($weekdays);
    }
}
