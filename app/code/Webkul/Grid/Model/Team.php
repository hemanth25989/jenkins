<?php
/**
 * Webkul_Grid Status Options Model.
 * @category    Webkul
 * @author      Webkul Software Private Limited
 */
namespace Webkul\Grid\Model;

use Magento\Framework\Data\OptionSourceInterface;

class Team extends \Magento\Framework\Model\AbstractModel implements OptionSourceInterface
{
	protected function _construct()
    {
        $this->_init('Webkul\Grid\Model\ResourceModel\Team');
    }
    /**
     * Get Grid row team type labels array.
     * @return array
     */
    public function getOptionArray()
    {
        $options = ['0' => __('MSS'),'1' => __('Ecommerce'),'2' => __('BSS'),'3' => __('OPS'),'4' => __('Hosting'),'5' => __('Managers')];
        return $options;
    }

    /**
     * Get Grid row status labels array with empty value for option element.
     *
     * @return array
     */
    public function getAllOptions()
    {
        $res = $this->getOptions();
        array_unshift($res, ['value' => '', 'label' => '']);
        return $res;
    }

    /**
     * Get Grid row type array for option element.
     * @return array
     */
    public function getOptions()
    {
        $objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
		$connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION'); 
		$result = $connection->fetchAll("SELECT team_id,team_name FROM team_details");
		
		foreach ($result as $index => $value) {
            $options[] = ['value' => $value['team_id'], 'label' => $value['team_name']];
        }
		
        return $options;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getOptions();
    }

	public function content($team_id) {
		
		$objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
		$connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION'); 
		if($team_id != "all"){
			$result = $connection->fetchAll("SELECT * FROM team_details where team_id = $team_id");
		}
		else{
			$result = $connection->fetchAll("SELECT * FROM team_details");
		}	
		return $result;
	}
	
	public function getTeamFullDetails() {
		
		$objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
		$connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION'); 
		$teams = $connection->fetchAll("SELECT * FROM team_details");
		
		foreach($teams as $key => $team)
		{	
			$team_id = $team['team_id'];
			$developers = $connection->fetchAll("SELECT * FROM wk_grid_records where team_name = $team_id");
			$team['members'] = $developers;
			$teamdetails[$key] = $team;
		}
		$result = $teamdetails;
		
		return $result; 
	}
	
}
