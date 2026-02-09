# LCB_CustomMessages

Render any message on any OpenMage route.

# Adding custom handles with rewrite

```
<models>
    <lcb_custom_messages>
        <rewrite>
            <system_config_handle>Vendor_Module_Rewrite_CustomMessages_Model_System_Config_Handle</system_config_handle>
        </rewrite>
    </lcb_custom_messages>
</models>
```

```
<?php
class Vendor_Module_Rewrite_CustomMessages_Model_System_Config_Handle extends LCB_CustomMessages_Model_System_Config_Handle
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = parent::toOptionArray();

        $helper = Mage::helper('core');

        $custom = array();
        $custom['custom_handle'] = $helper->__('Custom Handle');

        foreach ($custom as $key => $option) {
            $custom[$key] = "$option ($key)";
        }

        $options = array_merge($options, $custom);

        asort($options);

        return $options;
    }
}
```

# Uninstall

```
DELETE FROM `core_resource` WHERE `code` = 'lcb_custom_messages_setup';
DELETE FROM `core_config_data` WHERE `path` LIKE 'lcb_custom_messages%';
DROP TABLE `lcb_custom_messages_notification`;
```