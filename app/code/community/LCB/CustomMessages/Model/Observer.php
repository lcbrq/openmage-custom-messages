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
        Mage::getModel('lcb_custom_messages/system_config_handle');
        if ($layout = $observer->getLayout()) {
            $update = $layout->getUpdate();
            $messageHandles = Mage::helper('lcb_custom_messages')->getHandles();
            if ($update && $messageHandles && ($layoutHandles = $update->getHandles())) {
                foreach ($layoutHandles as $layoutHandle) {
                    if (!empty($messageHandles[$layoutHandle])) {
                        foreach ($messageHandles[$layoutHandle] as $notification) {
                            $session   = Mage::getSingleton('core/session');
                            $messageId = (int) $notification['entity_id'];
                            $showMode  = (int) $notification['show_mode'];
                            $message = $notification['message'];
                            $sessionKey = 'custom_message_shown_' . $messageId;

                            if ($showMode === 0) {
                                $session->unsetData($sessionKey);
                            }

                            if ($showMode === 1 && $session->getData($sessionKey)) {
                                continue;
                            }

                            switch ($notification['type']) {
                                case 'warning':
                                    Mage::getSingleton('core/session')->addWarning($message);
                                    break;
                                case 'success':
                                    Mage::getSingleton('core/session')->addSuccess($message);
                                    break;
                                default:
                                    Mage::getSingleton('core/session')->addNotice($message);
                                    break;
                            }

                            if ($showMode === 1) {
                                $session->setData($sessionKey, true);
                            }
                        }
                    }
                }
                $update->addHandle('lcb_custom_message');
            }
        }
    }
}
