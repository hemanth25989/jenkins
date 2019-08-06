<?php
/**
 * Webkul_Grid Add New Row Form Admin Block.
 * @category    Webkul
 * @package     Webkul_Grid
 * @author      Webkul Software Private Limited
 *
 */
namespace Webkul\Grid\Block\Adminhtml\Team\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context,
     * @param \Magento\Framework\Registry $registry,
     * @param \Magento\Framework\Data\FormFactory $formFactory,
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
     * @param \Webkul\Grid\Model\Status $options,
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Webkul\Grid\Model\Status $options,
        \Webkul\Grid\Model\Team $teams,
        array $data = []
    ) {
        $this->_options = $options;
        $this->_teams = $teams;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form',
                            'enctype' => 'multipart/form-data',
                            'action' => $this->getData('action'),
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getTeamId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('team_id', 'hidden', ['name' => 'team_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }

		
		$fieldset->addField(
            'team_name',
            'text',
            [
                'name' => 'team_name',
                'label' => __('Team Name'),
                'id' => 'team_name',
                'title' => __('Team Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
		$fieldset->addField(
    		'team_image',
    		'image',
    		[
                'name'     => 'team_image',
                'label'    => __('Team Image'),
                'title'    => __('Team Image'),
				'id' => 'team_image',
            ]
    	);
		
	    $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        $fieldset->addField(
            'team_description',
            'editor',
            [
                'name' => 'team_description',
                'label' => __('Team Description'),
                'style' => 'height:36em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );
		
		 /* $fieldset->addField(
            'team_name',
            'text',
            [
                'name' => 'team_name',
                'label' => __('Team Name'),
                'id' => 'team_name',
                'title' => __('Team Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );*/
		/*$fieldset->addField(
			'developer_image',
			[
			   'header' => __('Developer Image'),
			   'index' => 'developer_image',
			   'renderer'  => 'Webkul\Grid\Block\Adminhtml\Developer\Grid\Renderer\Image',
			]
		);
		$fieldset->addField(
			'developer_image',
			'text',
			[
				'name' => 'developer_image',
				'label' => __('Developer Image'),
				'id' => 'developer_image',
				'title' => __('Developer Image'),
				'class' => 'required-entry',
				'required' => true,
			]
		);*/
        /*$fieldset->addField(
            'publish_date',
            'date',
            [
                'name' => 'publish_date',
                'label' => __('Publish Date'),
                'date_format' => $dateFormat,
                'time_format' => 'H:mm:ss',
                'class' => 'validate-date validate-date-range date-range-custom_theme-from',
                'class' => 'required-entry',
                'style' => 'width:200px',
            ]
        );
        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active',
                'label' => __('Status'),
                'id' => 'is_active',
                'title' => __('Status'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );*/
		
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
