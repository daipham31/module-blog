<?php
namespace Duud\Blog\Api\Data;


interface CommentInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const COMMENT_ID        = 'comment_id';
    const POST_ID           = 'post_id';
    const TEXT              = 'text';
    const AUTHOR_NICKNAME   = 'author_nickname';
    const AUTHOR_EMAIL      = 'author_email';
    const CREATION_TIME     = 'creation_time';
    const UPDATE_TIME       = 'update_time';
    const STATUS            = 'status';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Pos Id
     *
     * @return int|null
     */
    public function getPostId();

    /**
     * Get text
     *
     * @return string|null
     */
    public function getText();

    /**
     * Get Author Nickname
     *
     * @return string|null
     */
    public function getAuthorNickname();

    /**
     * Get Author Email
     *
     * @return string|null
     */
    public function getAuthorEmail();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Status
     *
     * @return bool|null
     */
    public function getStatus();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Duud\Blog\Api\Data\CommentInterface
     */
    public function setId($id);

    /**
     * Set ID
     *
     * @param int $post_id
     * @return \Duud\Blog\Api\Data\CommentInterface
     */
    public function setPostId($post_id);

    /**
     * Set Text
     *
     * @param string $text
     * @return \Duud\Blog\Api\Data\CommentInterface
     */
    public function setText($text);

    /**
     * Set Author Nickname
     *
     * @param string $author_nickname
     * @return \Duud\Blog\Api\Data\CommentInterface
     */
    public function setAuthorNickname($author_nickname);


    /**
     * Set Author Email
     *
     * @param string $author_email
     * @return \Duud\Blog\Api\Data\CommentInterface
     */
    public function setAuthorEmail($author_email);


    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \Duud\Blog\Api\Data\CommentInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \Duud\Blog\Api\Data\CommentInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return \Duud\Blog\Api\Data\CommentInterface
     */
    public function setStatus($status);
}
