<?php

namespace Duud\CustomizeProduct\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Fieldset;

class Test extends AbstractModifier
{
    public function modifyMeta(array $meta)
    {
        $meta['stock_data'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Manage Stock'),
                        'sortOrder' => 50,
                        'collapsible' => true
                    ]
                ]
            ]
        ];

        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }
}