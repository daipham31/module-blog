<?php

namespace Duud\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Duud\Blog\Api\Data\CommentInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Comment extends AbstractModel implements CommentInterface, IdentityInterface
{

    const CACHE_TAG = 'blog_comment';

    const STATUS_PENDING = 0;
    const STATUS_DENIED = 1;
    const STATUS_APPROVE = 2;


    protected $_cacheTag = 'blog_comment';

    protected $_eventPrefix = 'blog_comment';

    protected $_urlBuilder;

    function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init('Duud\Blog\Model\ResourceModel\Comment');
    }

    public function getAvailableStatuses()
    {
        return [
            self::STATUS_PENDING => __('Pending'),
            self::STATUS_DENIED => __('Denied'),
            self::STATUS_APPROVE => __('Approve')
        ];
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId()
    {
        return $this->getData(self::COMMENT_ID);
    }

    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    public function getPostID()
    {
        return $this->getData(self::POST_ID);
    }

    public function getAuthor()
    {
        return $this->getData(self::AUTHOR);
    }

    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    public function setId($id)
    {
        return $this->setData(self::COMMENT_ID, $id);
    }

    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    public function setAuthor($author)
    {
        return $this->setData(self::AUTHOR, $author);
    }

    public function setPostId($post_id)
    {
        return $this->setData(self::POST_ID, $post_id);
    }

    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

}
