<?php

/**
 * @author Tomasz Gregorczyk <tom@lcbrq.com>
 */
class LCB_CustomMessages_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @var string
     */
    public const XPATH_CUSTOM_MESSAGES_HANDLES = 'lcb_custom_messages/settings/handles';

    /**
     * @return array
     */
    public function getHandles()
    {
        $handles = [];

        if ($config = Mage::getStoreConfig(self::XPATH_CUSTOM_MESSAGES_HANDLES, Mage::app()->getStore())) {
            try {
                if ($unserializedConfig = unserialize($config)) {
                    foreach ($unserializedConfig as $handleData) {
                        if ($handleData['active']) {
                            $handles[$handleData['handle']][] = [
                                'title'  => $handleData['title'] ?? '',
                                'message' => $handleData['message'] ?? '',
                            ];
                        }
                    }
                }
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }

        return $handles;
    }
}
