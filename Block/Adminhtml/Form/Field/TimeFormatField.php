<?php
namespace MageGro\OpeningsTime\Block\Adminhtml\Form\Field;

class TimeFormatField extends \Magento\Config\Block\System\Config\Form\Field {

  
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element) {
        $element->setOnchange('resolveTime();');
        $html = $element->getElementHtml();
        $html .= '<script type="text/javascript">
        require(["jquery"], function ($) {
            $(document).ready(function () {
                resolveTime = function(){
                    $("tbody:last tr td.value .hour option:selected").each(
                        function(){
                                $(this).text(08);
                                $(this).val("08");

                            
                        }
                    );                }
        });
    });
            </script>';
        return $html;
    }

}