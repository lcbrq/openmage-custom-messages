<?php

class LCB_CustomMessages_Model_System_Config_Handle extends Mage_Core_Model_Config_Data
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $helper = Mage::helper('core');

        return array(
            'custom' => $helper->__('Custom'),
            'default' => $helper->__('Default'),

            // CMS
            'cms_index_index' => $helper->__('Home Page'),
            'cms_page'        => $helper->__('CMS Pages'),
            'cms_page_view'   => $helper->__('CMS Page'),

            // Catalog
            'catalog_category_view'    => $helper->__('Category View'),
            'catalog_category_layered' => $helper->__('Layered Navigation'),
            'catalog_product_view'     => $helper->__('Product View'),

            // Search
            'catalogsearch_result_index'    => $helper->__('Search Results'),
            'catalogsearch_advanced_index'  => $helper->__('Advanced Search'),
            'catalogsearch_advanced_result' => $helper->__('Search Results'),

            // Customer
            'customer_account_index'          => $helper->__('My Account'),
            'customer_account_login'          => $helper->__('Login'),
            'customer_account_create'         => $helper->__('Create an Account'),
            'customer_account_edit'           => $helper->__('Account Information'),
            'customer_account_forgotpassword' => $helper->__('Forgot Your Password?'),
            'customer_address_index'          => $helper->__('Address Book'),
            'customer_address_form'           => $helper->__('Edit Address'),

            // Cart / Checkout
            'checkout_cart_index'          => $helper->__('Shopping Cart'),
            'checkout_onepage_index'       => $helper->__('Checkout'),
            'checkout_onepage_success'     => $helper->__('Success'),
            'checkout_multishipping_addresses' => $helper->__('Ship to Multiple Addresses'),
            'checkout_multishipping_success'   => $helper->__('Success'),

            // Wishlist / Compare
            'wishlist_index_index'          => $helper->__('My Wishlist'),
            'catalog_product_compare_index' => $helper->__('Compare Products'),

            // Orders (My Account)
            'sales_order_history' => $helper->__('My Orders'),
            'sales_order_view'    => $helper->__('Order View'),
            'sales_order_invoice' => $helper->__('Invoices'),
            'sales_order_shipment'=> $helper->__('Shipments'),
            'sales_order_creditmemo' => $helper->__('Refunds'),

            // Misc
            'contacts_index_index'    => $helper->__('Contact form'),
            'newsletter_manage_index' => $helper->__('Newsletter Subscriptions'),
        );
    }
}
