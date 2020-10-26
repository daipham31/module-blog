<?php

namespace Duud\Blog\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use Duud\Blog\Model\Comment;
use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Duud_Blog::save';
    protected $dataPersistor;
    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor
    )
    {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            // Optimize data
            if (empty($data['comment_id'])) {
                $data['comment_id'] = null;
            }
            // Init model and load by ID if exists
            $model = $this->_objectManager->create('Duud\Blog\Model\Comment');
            $id = $this->getRequest()->getParam('comment_id');
            if ($id) {
                $model->load($id);
            }
            // Update model
            $model->setData($data);
            // Save data to database
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the image.'));
                $this->dataPersistor->clear('banner');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['comment_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the image.'));
            }
            $this->dataPersistor->set('banner', $data);
            return $resultRedirect->setPath('*/*/edit', ['comment_id' => $this->getRequest()->getParam('comment_id')]);
        }
        // Redirect to List page
        return $resultRedirect->setPath('*/*/');
    }
}


