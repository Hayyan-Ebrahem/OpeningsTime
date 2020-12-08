<?php

namespace MageGro\OpeningsTime\Model\Config\Source;


class Custom implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'AM', 'label' => __('AM')],
            ['value' => 'PM', 'label' => __('PM')]
        ];
    }



}
