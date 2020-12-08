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

    public function getWeekdays()
    {
        $localeweekdays = array_column($this->getLocaleWeekdays(), 'label');
        $weekdays = [];
        $days = $this->helperData->getDaysConfig();

        foreach ($days as $day => $time) {
            foreach ($localeweekdays as  $label => $value) {
                if (strtok($day, '_') === $value) {
                    $weekdays[$label][$value][] = $time;
                }
            }
        }
        ksort($weekdays);
        // foreach ($weekdays as $day => $time) {

        //     $data[] = ['day' => $day, 'time' => [
        //         'openingtime' => str_replace(",", ":", $time[0]),
        //         'closingtime' => str_replace(",", ":", $time[1])
        //     ]];
        // }
        return $weekdays;

    }
}
