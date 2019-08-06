<?php

namespace Webkul\Grid\Block;

use Magento\Framework\View\Element\Template\Context;
use Webkul\Grid\Model\GridFactory;

/**
 * Developer List block
 */
class DeveloperListData extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Context $context,
        GridFactory $developerlist
    ) {
        $this->_developerlist = $developerlist;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Developer Details'));
        
        return parent::_prepareLayout();
    }

    public function getDeveloperCollection()
    {
        $developerlist = $this->_developerlist->create();
		$objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
		$team_id = $objectManager->get('\Magento\Framework\App\Request\Http')->getParam('team_id');
        $collection = $developerlist->getCollection();
		if($team_id){
			$collection->addFieldToFilter('team_name', $team_id);
		}
        return $collection;
    }
	
	/** To get the Team Name */
	public function getTeamName($team_id)
    {
        $objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
		$connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION'); 
		$result = $connection->fetchAll("SELECT team_name FROM team_details where team_id= $team_id");
		
        return $result[0]['team_name'];
    }
}