<?php


$installer = $this;
$installer->startSetup();

$tableName  = $installer->getTable('lcb_custom_messages/notification');
$connection = $installer->getConnection();

if ($connection->isTableExists($tableName) && !$connection->tableColumnExists($tableName, 'show_mode')) {
    $connection->addColumn(
        $tableName,
        'show_mode',
        array(
            'type'     => Varien_Db_Ddl_Table::TYPE_SMALLINT,
            'nullable' => false,
            'default'  => 0,
            'comment'  => 'Show Mode'
        )
    );
}

$installer->endSetup();
