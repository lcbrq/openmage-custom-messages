<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

foreach (Mage::app()->getStores() as $store) {
    if ($store->getId() < 1) {
        continue;
    }
    if ($config = Mage::getStoreConfig('lcb_custom_messages/settings/handles', $store)) {
        try {
            if ($unserializedConfig = unserialize($config)) {
                foreach ($unserializedConfig as $handleData) {
                    Mage::getModel('lcb_custom_messages/notification')->setData([
                        'handle' => $handleData['handle'],
                        'title' => $handleData['title'],
                        'message' => $handleData['message'],
                        'status' => $handleData['active'],
                        'type' => 'notice',
                        'store_id' => $store->getId(),
                    ])->save();
                }
            }
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }
}
$installer->endSetup();
