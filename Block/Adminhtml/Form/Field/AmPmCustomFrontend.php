<?php

namespace MageGro\OpeningsTime\Block\Adminhtml\Form\Field;

class AmPmCustomFrontend extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    public function getElementHtml()
    {
        $this->addClass('AmPm');

        $html = parent::getElementHtml();
        return $html;
    }
}
