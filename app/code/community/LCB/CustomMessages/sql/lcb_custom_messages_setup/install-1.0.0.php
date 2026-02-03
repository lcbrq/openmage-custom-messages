<?php

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable('lcb_custom_messages/notification');

if (!$installer->getConnection()->isTableExists($tableName)) {
    $table = $installer->getConnection()
        ->newTable($tableName)
        ->addColumn(
            'entity_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            array(
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
            ),
            'Request Id'
        )
        ->addColumn(
            'handle',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            64,
            array(),
            'Handle'
        )
        ->addColumn(
            'title',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            64,
            array(),
            'Title'
        )
        ->addColumn(
            'message',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            1024,
            array(),
            'Message'
        )
        ->addColumn(
            'status',
            Varien_Db_Ddl_Table::TYPE_SMALLINT,
            null,
            array(),
            'Status'
        )
        ->addColumn(
            'type',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            32,
            array(),
            'Type'
        )
        ->addColumn(
            'store_id',
            Varien_Db_Ddl_Table::TYPE_SMALLINT,
            null,
            array(),
            'Store ID'
        )
        ->addColumn(
            'created_at',
            Varien_Db_Ddl_Table::TYPE_DATETIME,
            null,
            array(),
            'Created At'
        );

    $installer->getConnection()->createTable($table);
}

$installer->endSetup();
