<?php

/**
 * Grid Grid Collection.
 *
 * @category  Webkul
 * @package   Webkul_Grid
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\Grid\Model\ResourceModel\Team;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'team_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Webkul\Grid\Model\Team',
            'Webkul\Grid\Model\ResourceModel\Team'
        );
    }
}
