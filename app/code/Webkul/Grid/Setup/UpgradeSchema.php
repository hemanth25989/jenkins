<?php
namespace Webkul\Grid\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;

		$installer->startSetup();

		if(version_compare($context->getVersion(), '2.0.1', '<')) {

			$installer->getConnection()->addColumn(
				$installer->getTable( 'wk_grid_records' ),
				 'team_name',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'length' => 255,
					'nullable' => true,
					'comment' => 'Team Name'
				]
				);
		}
		if(version_compare($context->getVersion(), '2.0.2', '<')) {

			$installer->getConnection()->addColumn(
				$installer->getTable( 'wk_grid_records' ),
				 'developer_name',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'length' => 255,
					'nullable' => true,
					'comment' => 'Developer Name'
				]
			);
		}
		if(version_compare($context->getVersion(), '2.0.3', '<')) {

			$installer->getConnection()->dropColumn($installer->getTable( 'wk_grid_records' ),'update_time');
			$installer->getConnection()->dropColumn($installer->getTable( 'wk_grid_records' ),'publish_date');
			$installer->getConnection()->dropColumn($installer->getTable( 'wk_grid_records' ),'is_active');
			$installer->getConnection()->addColumn($installer->getTable( 'wk_grid_records' ),
				'developer_image',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'length' => 255,
					'nullable' => true,
					'comment' => 'Developer Image'
				]
			);
		}
		if(version_compare($context->getVersion(), '2.0.4', '<')) {

			$installer->getConnection()->dropColumn($installer->getTable( 'wk_grid_records' ),'title');
		}
		if(version_compare($context->getVersion(), '2.0.5', '<')) {

			$table = $installer->getConnection()->newTable(
			$installer->getTable('team_details')
			)->addColumn(
				'team_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
				null,
				['nullable' => false, 'primary' => true],
				'Team Id'
			)->addColumn(
				'team_name',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Team Name'
			)->addColumn(
				'team_description',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Team Description'
			)->addColumn(
				'team_image',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Team Image'
			);
			
			/*$installer->getConnection()->addForeignKey(
                $installer->getFkName(
                    'wk_grid_records',
                    'team_name',
                    'team_details',
                    'entity_id'
                ),
                'main_id',
                $installer->getTable('wk_main_table'), 
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );*/
		}
		if(version_compare($context->getVersion(), '2.0.6', '<')) {
			//echo 'test';exit;
			$table = $installer->getConnection()->newTable(
			$installer->getTable('team_details')
			)->addColumn(
				'team_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
				null,
				['nullable' => false, 'primary' => true],
				'Team Id'
			)->addColumn(
				'team_name',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Team Name'
			)->addColumn(
				'team_description',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Team Description'
			)->addColumn(
				'team_image',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Team Image'
			);
			$installer->getConnection()->createTable($table);
			/*$installer->getConnection()->addForeignKey(
                $installer->getFkName(
                    'wk_grid_records',
                    'team_name',
                    'team_details',
                    'entity_id'
                ),
                'main_id',
                $installer->getTable('wk_main_table'), 
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );*/
		}
		if(version_compare($context->getVersion(), '2.0.7', '<')) {
			//echo 'test';exit;
			$table = $installer->getConnection()->newTable(
			$installer->getTable('team_details')
			)->addColumn(
				'team_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
				null,
				['nullable' => false, 'primary' => true],
				'Team Id'
			)->addColumn(
				'team_name',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Team Name'
			)->addColumn(
				'team_description',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Team Description'
			)->addColumn(
				'team_image',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Team Image'
			);
			$installer->getConnection()->createTable($table);
			/*$installer->getConnection()->addForeignKey(
                $installer->getFkName(
                    'wk_grid_records',
                    'team_name',
                    'team_details',
                    'entity_id'
                ),
                'main_id',
                $installer->getTable('wk_main_table'), 
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );*/
		}
		if(version_compare($context->getVersion(), '2.0.8', '<')) {
			/*$installer->getConnection()->addForeignKey(
                $installer->getFkName(
                    'wk_grid_records',
                    'team_name',
                    'team_details',
                    'team_id'
                ),
                'team_id',
                $installer->getTable('wk_grid_records'), 
                'team_name',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );*/
						
			$installer->getConnection()->addColumn($installer->getTable( 'wk_grid_records' ),
				'e_mail',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'length' => 255,
					'nullable' => true,
					'comment' => 'E-Mail'
				]
			);
			$installer->getConnection()->addColumn($installer->getTable( 'wk_grid_records' ),
				'mobile_no',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'length' => 255,
					'nullable' => true,
					'comment' => 'Mobile number'
				]
			);
		}
		if(version_compare($context->getVersion(), '2.0.9', '<')) {
			
			$installer->getConnection()->addColumn($installer->getTable( 'wk_grid_records' ),
				'developer_image_path',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'length' => 255,
					'nullable' => true,
					'comment' => 'Developer Image Path'
				]
			);
		}
		if(version_compare($context->getVersion(), '2.0.10', '<')) {
			
			$installer->getConnection()->addColumn($installer->getTable( 'team_details' ),
				'team_image_path',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'length' => 255,
					'nullable' => true,
					'comment' => 'Team Image Path'
				]
			);
		}
		$installer->endSetup();
	}
}
