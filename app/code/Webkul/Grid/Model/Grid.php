<?php

/**
 * Grid Grid Model.
 * @category  Webkul
 * @package   Webkul_Grid
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\Grid\Model;

use Webkul\Grid\Api\GridInterface;
//use Magento\Framework\Model\AbstractModel;

class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
	protected function _construct()
    {
        $this->_init('Webkul\Grid\Model\ResourceModel\Grid');
    }
	
	 /**
     * Get Grid row team type labels array.
     * @return array
     */
    public function getOptionArray()
    {
        $objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
		$connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION'); 
		$result = $connection->fetchAll("SELECT team_id,team_name FROM team_details");
		
		foreach ($result as $index => $value) {
            $options[] = ['value' => $value['team_id'], 'label' => $value['team_name']];
        }
		
        return $options;
    }
	
   	
	public function content($team_id) {
		
		$objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
		$connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION'); 
		$result = $connection->fetchAll("SELECT * FROM wk_grid_records where team_name = $team_id");
		return $result;
	}
	
	
}