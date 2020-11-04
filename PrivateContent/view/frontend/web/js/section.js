define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'Magento_Customer/js/section-config'
], function (Component, customerData, config) {
    'use strict';

    return Component.extend({
        /** @inheritdoc */
        initialize: function () {
            this._super();
            this.customsection = customerData.get('customsection');

            customerData.reload('customsection');
            this.customsection = customerData.get('customsection');
        }
    });
});