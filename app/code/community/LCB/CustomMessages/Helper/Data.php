<?php

/**
 * @author Tomasz Gregorczyk <tom@lcbrq.com>
 */
class LCB_CustomMessages_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
      * @var string
      */
    public const XPATH_CUSTOM_MESSAGES_ENABLED = 'lcb_custom_messages/settings/enable';

    /**
     * @return array
     */
    public function getHandles()
    {
        $handles = [];

        if (!Mage::getStoreConfigFlag(self::XPATH_CUSTOM_MESSAGES_ENABLED)) {
            return $handles;
        }

        $collection = Mage::getModel('lcb_custom_messages/notification')
                ->getCollection()
                ->addFieldToFilter('status', true);

        foreach ($collection as $notification) {
            $handles[$notification->getHandle()][] = [
                'title' => $notification->getTitle(),
                'message' => $notification->getMessage(),
                'type' => $notification->getType(),
            ];
        }

        return $handles;
    }
}
