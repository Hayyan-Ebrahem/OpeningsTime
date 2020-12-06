<?php

namespace Hayyan\OpeningsTime\Block;


class OpeningsTime extends \Magento\Framework\View\Element\Template
{
    protected $helperData;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Hayyan\OpeningsTime\Helper\Data $helperData,
        array $data = []
    ) {
        $this->helperData = $helperData;
        parent::__construct($context, $data);
    }


    public function getWeekdays()
    {
        $weekdays = [];
        $days = $this->helperData->getDaysConfig();
        
        $pre = "_";

        foreach ($days as $day => $time) {
            $weekdays[$day] = [$time];

            if (substr($day, 0, strlen($pre)) === $pre) {
                unset($weekdays[$day]);

                $day = substr($day, strlen($pre));
                array_push($weekdays[$day], $time);
            }
        }
        foreach ($weekdays as $day => $time) {

            $data[] = ['day' => $day, 'time' => [
                'openingtime' => str_replace(",", ":", $time[0]),
                'closingtime' => str_replace(",", ":", $time[1])
            ]];
        }
 
        return $data;
    }
}
