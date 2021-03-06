<?php

namespace Duud\Blog\Setup;

use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class UpgradeData
 *
 * @package Duud\Blog\Setup
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

        if ($context->getVersion()
            && version_compare($context->getVersion(), '0.0.3') < 0
        ) {
            $tableName = $installer->getTable('duud_blog_post');

            $data = [
                [
                    'title' => 'Post 3 Title',
                    'url_key' => 'post-3',
                    'content' => 'Content of the first post.',
                ],
                [
                    'title' => 'Post 4 Title',
                    'url_key' => 'post-4',
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