<?php


$installer = $this;
$installer->startSetup();

$tableName  = $installer->getTable('lcb_custom_messages/notification');
$connection = $installer->getConnection();

if ($connection->isTableExists($tableName) && !$connection->tableColumnExists($tableName, 'additional_data')) {
    $connection->addColumn(
        $tableName,
        'additional_data',
        array(
            'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
            'nullable' => true,
            'comment'  => 'Additional Data'
        )
    );
}

$installer->endSetup();
