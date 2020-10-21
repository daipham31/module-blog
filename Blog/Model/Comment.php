<?php
namespace Duud\Blog\Model;

use Duud\Blog\Api\Data\CommentInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Comment extends \Magento\Framework\Model\AbstractModel implements PostInterface, IdentityInterface
{

}
?>