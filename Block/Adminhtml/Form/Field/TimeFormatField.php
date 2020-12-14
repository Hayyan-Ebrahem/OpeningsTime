<?php	
namespace MageGro\OpeningsTime\Block\Adminhtml\Form\Field;	

class TimeFormatField extends \Magento\Config\Block\System\Config\Form\Field {	


    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element) {	
        $element->addClass("ampm");
        $html = $element->getElementHtml();	
        $html .= '<script type="text/javascript">	
        requirejs(["jquery", "timeformat"], function($){
            // Your Code
        });
            </script>';	
        return $html;	
    }	

}