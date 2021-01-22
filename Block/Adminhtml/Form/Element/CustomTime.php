<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magegro\OpeningsTime\Block\Adminhtml\Form\Element;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

/**
 * Form time element
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class CustomTime extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    protected $helperData;


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
        \Magento\Framework\Escaper $escaper,
        $data = [],
        ?SecureHtmlRenderer $secureRenderer = null

    ) {
        $secureRenderer = $secureRenderer ?? ObjectManager::getInstance()->get(SecureHtmlRenderer::class);
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data, $secureRenderer);
        $this->secureRenderer = $secureRenderer;
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

    /**
     * @inheritDoc
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function getElementHtml()
    {
        $this->addClass('select admin__control-select');
        $this->addClass('select80wide');

        $valueHrs = 0;
        $valueMin = 0;

        if ($value = $this->getValue()) {
            $values = explode(',', $value);
            if (is_array($values)) {
                $valueHrs = $values[0];
                $valueMin = $values[1];
            }
        }

        $html = '<input type="hidden" id="' . $this->getHtmlId() . '" ' . $this->_getUiId() . '/>';
        $html .= '<select name="' . $this->getName() . '" '
            . $this->serialize($this->getHtmlAttributes())
            . $this->_getUiId('hour') . '>' . "\n";
        for ($i = 0; $i < 24; $i++) {
            $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
            $html .= '<option value="' . $hour . '" ' . ($valueHrs ==
                $i ? 'selected="selected"' : '') . '>' . $hour . '</option>';
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

        $html .= $this->getAfterElementHtml();
        $html .= $this->secureRenderer->renderTag(
            'style',
            [],
            <<<style
                .select80wide {
                    width: 80px;
                }
style
            ,
            false
        );

        return $html;
    }
}
