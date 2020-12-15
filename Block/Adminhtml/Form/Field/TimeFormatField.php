<?php	
namespace MageGro\OpeningsTime\Block\Adminhtml\Form\Field;	

class TimeFormatField extends \Magento\Config\Block\System\Config\Form\Field {	


    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element) {	
        $element->addClass("ampmtimeformat");
        $html = $element->getElementHtml();	
        $html .= '<script>	
        requirejs(["jquery", "timeformat"], function($){
        });
            </script>';	
        return $html;	
    }	

}