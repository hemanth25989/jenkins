<?php

namespace Webkul\Grid\Block;

use Magento\Framework\View\Element\Template\Context;
use Webkul\Grid\Model\TeamFactory;

/**
 * Team List block
 */
class TeamListData extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Context $context,
        TeamFactory $teamlist
    ) {
        $this->_teamlist = $teamlist;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Team Details'));
        
        return parent::_prepareLayout();
    }

    public function getTeamCollection()
    {
        $teamlist = $this->_teamlist->create();
        $collection = $teamlist->getCollection();
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