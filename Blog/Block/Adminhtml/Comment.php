<?php
namespace Duud\Blog\Block\Adminhtml;

class comment extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_comment';
        $this->_blockGroup = 'Duud_Blog';
        $this->_headerText = __('Manage Blog Comment');

        parent::_construct();

        if ($this->_isAllowedAction('Duud_Blog::save')) {
            $this->buttonList->update('add', 'label', __('Add New Comment'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
