<?php
namespace Duud\Blog\Block;

use Duud\Blog\Api\Data\PostInterface;
use Duud\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use Duud\Blog\Model\Post;
class PostList extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * @var \Duud\Blog\Model\ResourceModel\Post\CollectionFactory
     */
    protected $_postCollectionFactory;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Duud\Blog\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Duud\Blog\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_postCollectionFactory = $postCollectionFactory;
    }

    /**
     * @return \Duud\Blog\Model\ResourceModel\Post\Collection
     */
    public function getPosts()
    {
        if (!$this->hasData('posts')) {
            $posts = $this->_postCollectionFactory
                ->create()
                ->addFilter('is_active', 1)
                ->addOrder(
                    PostInterface::CREATION_TIME,
                    PostCollection::SORT_ORDER_DESC
                );
            $this->setData('posts', $posts);
        }
        return $this->getData('posts');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        $identities = [];

        if (is_array($this->getPosts()) || is_object($this->getPosts()))
        {
            foreach ($this->getPosts() as $item)
            {
                $identities = array_merge($identities, $item->getIdentities());
            }
        }
        return array_unique($identities);
    }

}
