<?php

namespace Duud\Blog\Api\Data;

interface CommentInterface
{

    const COMMENT_ID        = 'comment_id';
    const CONTENT           = 'content';
    const AUTHOR            = 'author';
    const POST_ID           = 'post_id';
    const CREATION_TIME     = 'creation_time';
    const EMAIL             = 'email';
    const STATUS            = 'status';
    const USER_ID           = 'user_id';



    public function getId();

   
    public function getContent();

   
    public function getAuthor();

    
    public function getPostId();
    

    public function getCreationTime();


    public function getEmail();


    public function getStatus();


    public function setId($id);


    public function setContent($content);


    public function setAuthor($author);


    public function setPostId($post_id);


    public function setCreationTime($creationTime);


    public function setEmail($email);


    public function setStatus($status);

   

}
