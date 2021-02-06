<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magegro\OpeningsTime\Model\Config\Source;

/**
 * @api
 * @since 100.0.2
 */
class Openclose implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [['value' => 1, 'label' => __('Open')], ['value' => 0, 'label' => __('Close')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [0 => __('Close'), 1 => __('Open')];
    }
}
