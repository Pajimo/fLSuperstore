<?php
namespace flooringSuperstore\SampleRequest\Model;

use Magento\Framework\Model\AbstractModel;

class SampleRequest extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('flooringSuperstore\SampleRequest\Model\ResourceModel\SampleRequest');
    }
}
