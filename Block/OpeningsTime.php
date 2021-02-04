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
        $days = $this->helperData->getDaysConfig();


        foreach ($days as $day => $time) {
            $values = explode("_", $day);

            foreach ($localeweekdays as  $index => $mageday) {

                if ($values[0] == $mageday) {
                    $data[$index][$values[0]][$values[1]] =  $this->resolveTime($time);
                }
            }
        }

        $FirstDayIndex = $this->helperData->getFirstDay();

        $result = array_merge(array_slice($data, $FirstDayIndex, null, true), array_slice($data, 0, $FirstDayIndex, true));

        foreach ($result as $index => $day) {
            $daynameindex = array_search(key($day), $localeweekdays);

            $weekdays[$index] = ['dayindex' => $daynameindex, 'day' => key($day), 'time' => $day[$localeweekdays[$daynameindex]]];
        }

        return $weekdays;
    }
}
