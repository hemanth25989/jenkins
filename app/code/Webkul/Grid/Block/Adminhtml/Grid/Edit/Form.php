<?php
/**
 * Webkul_Grid Add New Row Form Admin Block.
 * @category    Webkul
 * @package     Webkul_Grid
 * @author      Webkul Software Private Limited
 *
 */
namespace Webkul\Grid\Block\Adminhtml\Grid\Edit;

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
        \Webkul\Grid\Model\Grid $teams,
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
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }

     
		$fieldset->addField(
            'team_name',
            'select',
            [
                'name' => 'team_name',
                'label' => __('Team'),
                'id' => 'team_name',
                'title' => __('Team'),
                'values' => $this->_teams->getOptionArray(),
                'class' => 'team_name',
                'required' => true,
            ]
        );
		$fieldset->addField(
    		'developer_image',
    		'image',
    		[
                'name'     => 'developer_image',
                'label'    => __('Developer Image'),
                'title'    => __('Developer Image'),
				'id' => 'developer_image',
            ]
    	);
		
	   $fieldset->addField(
            'developer_name',
            'text',
            [
                'name' => 'developer_name',
                'label' => __('Developer Name'),
                'id' => 'developer_name',
                'title' => __('Developer Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'style' => 'height:36em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );
		$fieldset->addField(
            'e_mail',
            'text',
            [
                'name' => 'e_mail',
                'label' => __('Email Id'),
                'id' => 'e_mail',
                'title' => __('Email Id'),
                'class' => 'required-entry validate-email',
                'required' => true,
            ]
        );
		$fieldset->addField(
            'mobile_no',
            'text',
            [
                'name' => 'mobile_no',
                'label' => __('Mobile Number'),
                'id' => 'mobile_no',
                'title' => __('Mobile Number'),
                'class' => 'required-entry validate-phoneStrict',
                'required' => true,
            ]
        );
		
		$form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
