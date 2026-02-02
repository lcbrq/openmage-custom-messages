<?php

/**
 * @author Tomasz Gregorczyk <tom@lcbrq.com>
 */
class LCB_CustomMessages_Model_Observer
{
    /**
     * @param  Varien_Event_Observer $observer
     * @return void
     */
    public function beforeLoadLayout(Varien_Event_Observer $observer)
    {
        /**
         * @todo replace with grid usage
         */
        if ($layout = $observer->getLayout()) {
            $update = $layout->getUpdate();
            $messageHandles = Mage::helper('lcb_custom_messages')->getHandles();
            if ($update && $messageHandles && ($layoutHandles = $update->getHandles())) {
                foreach ($layoutHandles as $layoutHandle) {
                    if (!empty($messageHandles[$layoutHandle])) {
                        foreach ($messageHandles[$layoutHandle] as $message) {
                            Mage::getSingleton('core/session')->addNotice($message);
                        }
                        $update->addHandle('lcb_custom_message');
                    }
                }
            }
        }
    }
}
