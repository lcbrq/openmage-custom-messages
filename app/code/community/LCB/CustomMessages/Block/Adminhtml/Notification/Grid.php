<?php

class LCB_CustomMessages_Block_Adminhtml_Notification_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('lcb_custom_messages_notification_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('lcb_custom_messages/notification')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            array(
               'header'=> $this->__('ID'),
               'width' => '50px',
               'index' => 'entity_id',
           )
        );

        $this->addColumn(
            'handle',
            array(
               'header'=> $this->__('Handle'),
               'index' => 'handle',
           )
        );

        $this->addColumn(
            'title',
            array(
               'header'=> $this->__('Title'),
               'index' => 'title',
           )
        );

        $this->addColumn(
            'type',
            array(
               'header'=> $this->__('Type'),
               'index' => 'type',
           )
        );

        $this->addColumn(
            'status',
            array(
               'header'=> $this->__('Enable'),
               'index' => 'status',
               'type' => 'options',
                'options' => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(),
           )
        );

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header' => $this->__('Store View'),
                'index' => 'store_id',
                'type' => 'store',
                'store_all' => true,
                'store_view' => true,
                'sortable' => true,
                'filter_condition_callback' => array($this, '_filterStoreCondition'),
            ));
        }

        $this->addColumn(
            'created_at',
            array(
               'header'=> $this->__('Utworzono'),
               'width' => '100px',
               'index' => 'created_at',
                'type' => 'datetime',
           )
        );

        return parent::_prepareColumns();
    }

    /**
     * Row URL
     *
     * @param Mage_Core_Model_Abstract $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }

    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addStoreFilter($value);
    }
}
