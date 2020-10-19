<?php

namespace Duud\BlogSimple\Setup;

use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class UpgradeData
 *
 * @package Duud\BlogSimple\Setup
 */
class UpgradeData implements UpgradeDataInterface
{

    /**
     * Creates sample blog posts
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if ($context->getVersion()
            && version_compare($context->getVersion(), '0.0.2') < 0
        ) {
            $tableName = $installer->getTable('duud_blog_post');

            $data = [
                [
                    'title' => 'Post 1 Title',
                    'content' => 'Content of the first post.',
                ],
                [
                    'title' => 'Post 2 Title',
                    'content' => 'Content of the second post.',
                ],
            ];

            $installer
                ->getConnection()
                ->insertMultiple($tableName, $data);
        }

        $installer->endSetup();


    }
}