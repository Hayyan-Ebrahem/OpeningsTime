<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Hayyan\OpeningsTime\Block\Adminhtml\Form\Element;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

/**
 * Form time element
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Time extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    protected $_scopeconfig;

    /**
     * @var SecureHtmlRenderer
     */
    private $secureRenderer;

    /**
     * @param Factory $factoryElement
     * @param CollectionFactory $factoryCollection
     * @param Escaper $escaper
     * @param array $data
     * @param SecureHtmlRenderer|null $secureRenderer
     * @param array $scopeconfig

     */
    public function __construct(

        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        Escaper $escaper,
        $data = [],
        ?SecureHtmlRenderer $secureRenderer = null,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeconfig

    ) {

        $secureRenderer = $secureRenderer ?? ObjectManager::getInstance()->get(SecureHtmlRenderer::class);
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data, $secureRenderer);
        $this->setType('time');
        $this->secureRenderer = $secureRenderer;
        $this->_scopeconfig = $scopeconfig;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        $name = parent::getName();
        if (strpos($name, '[]') === false) {
            $name .= '[]';
        }
        return $name;
    }

    public function getTimeConfig()
    {
        $timeFormat = $this->_scopeconfig->getValue('hayyan_store_openingstime_general/openings_time_settings/time_format');
        return $timeFormat;
    }

    /**
     * @inheritDoc
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function getElementHtml()
    {
        $timeFormat = substr($this->getTimeConfig(), 0, 2);
        $this->addClass('select admin__control-select');
        $this->addClass('select80wide');

        $valueHrs = 0;
        $valueMin = 0;
        // $valueSec = 0;
        // $valueFormat = "AM";

        if ($value = $this->getValue()) {
            $values = explode(',', $value);
            if (is_array($values) && count($values) == 3) {
                $valueHrs = $values[0];
                $valueMin = $values[1];
                // $valueSec = $values[2];
            }
        }

        $html = '<input type="hidden" id="' . $this->getHtmlId() . '" ' . $this->_getUiId() . '/>';
        $html .= '<select name="' . $this->getName() . '" '
            . $this->serialize($this->getHtmlAttributes())
            . $this->_getUiId('hour') . '>' . "\n";
        if ($timeFormat == 12) {

            for ($i = 1; $i <= $timeFormat; $i++) {
                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                $html .= '<option value="' . $hour . '" ' . ($valueHrs ==
                    $i ? 'selected="selected"' : '') . '>' . $hour . '</option>';
            }
        } else {
            for ($i = 0; $i < $timeFormat; $i++) {
                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                $html .= '<option value="' . $hour . '" ' . ($valueHrs ==
                    $i ? 'selected="selected"' : '') . '>' . $hour . '</option>';
            }
        }
        $html .= '</select>' . "\n";

        $html .= '<span class="time-separator">:&nbsp;</span><select name="'
            . $this->getName() . '" '
            . $this->serialize($this->getHtmlAttributes())
            . $this->_getUiId('minute') . '>' . "\n";
        for ($i = 0; $i < 60; $i++) {
            $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
            $html .= '<option value="' . $hour . '" ' . ($valueMin ==
                $i ? 'selected="selected"' : '') . '>' . $hour . '</option>';
        }
        $html .= '</select>' . "\n";

        // $html .= '<span class="time-separator">:&nbsp;</span><select name="'
        //     . $this->getName() . '" '
        //     . $this->serialize($this->getHtmlAttributes())
        //     . $this->_getUiId('second') . '>' . "\n";
        // for ($i = 0; $i < 60; $i++) {
        //     $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
        //     $html .= '<option value="' . $hour . '" ' . ($valueSec ==
        //         $i ? 'selected="selected"' : '') . '>' . $hour . '</option>';
        // }
        // $html .= '</select>' . "\n";


        if ($timeFormat == 12) {

            $html .= '<span>&nbsp;</span><select name="Time">';
            $arr = ['AM', 'PM'];
            foreach ($arr as $value) {
                $html .= '<option value="' . $value . '" '  . '>' . $value . '</option>';
            }
            
        }
        

        $html .= '</select>' . "\n";
        $html .= $this->getAfterElementHtml();
        $html .= $this->secureRenderer->renderTag(
            'style',
            [],
            <<<style
                .select80wide {
                    width: 80px;
                }
style,
            false
        );

        return $html;
    }
}
