README for Part 5 - Opentechiz Training
1. How to joins table in Magento 2
    Joins table in Magento 2 by Collection.
Ex: /Vendor/Module/Model/ResourceModel/JoinModel/Collection.php:
    
    Create a function to get data as need.

        protected function filterOrder($payment_method)
        {
            $this->sales_order_table = "main_table";
            $this->sales_order_payment_table = $this->getTable("sales_order_payment");
            $this->getSelect()
                ->join(array('payment' =>$this->sales_order_payment_table), $this->sales_order_table . '.entity_id= payment.parent_id',
                array('payment_method' => 'payment.method',
                    'order_id' => $this->sales_order_table.'.entity_id'
                )->where("payment_method=".$payment_method);
            );
            $this->getSelect();
        }
    
    In model, just need to get the collection and call to function above.

        $collection = $this->YourCollectionFactory->create();

            $collection->filterOrder("checkmo");

            foreach ($collection as $item) {
                //do what you want with the data here.
            }
    
    Var:
        $orderTable = $this->_resource->getTableName('sales_order');
        $customerTable = $this->_resource->getTableName('customer_entity');

        INNER JOIN:
            $joinCollection = $this->_joinFactory->create();
            $joinCollection
            ->getSelect()
            ->join(
            ['ot'=>$orderTable],
            "main_table.order_id = ot.entity_id"
        );

        SELECT `main_table`.*, `ot`.* FROM `wk_my_table_join_test` AS `main_table` INNER JOIN `wk_sales_order` AS `ot` ON main_table.order_id = ot.entity_id;

        LEFT JOIN:

            $joinCollection = $this->_joinFactory->create();
            $joinCollection
            ->getSelect()
            ->join(
                ['ot'=>$orderTable],
                "main_table.order_id = ot.entity_id",
                [
                    'increment_id' => 'ot.increment_id',
                    'status' => 'GROUP_CONCAT(ot.state)'
                ]
            )
            ->where("status = 'pending'")
            ->group("main_table.order_id");

        SELECT `main_table`.*, `ot`.`increment_id` FROM `wk_my_table_join_test` AS `main_table` INNER JOIN `wk_sales_order` AS `ot` ON main_table.order_id = ot.entity_id;

        Use Where Clause:

        $joinCollection = $this->_joinFactory->create();
        $joinCollection
        ->getSelect()
        ->join(
            ['ot'=>$orderTable],
            "main_table.order_id = ot.entity_id",
            [
                'increment_id' => 'ot.increment_id',
                'status' => 'ot.state'
            ]
        )
        ->where("status = 'pending'");

        SELECT `main_table`.*, `ot`.`increment_id`, `ot`.`state` AS `status` FROM `wk_my_table_join_test` AS `main_table` INNER JOIN `wk_sales_order` AS `ot` ON main_table.order_id = ot.entity_id WHERE (status = 'pending');

        how to use aggregate function like GROUP_CONCAT , COUNT etc :

        $joinCollection = $this->_joinFactory->create();
        $joinCollection
        ->getSelect()
        ->join(
            ['ot'=>$orderTable],
            "main_table.order_id = ot.entity_id",
            [
                'increment_id' => 'ot.increment_id',
                'status' => 'GROUP_CONCAT(ot.state)'
            ]
        )
        ->where("status = 'pending'")
        ->group("main_table.order_id");

        SELECT `main_table`.*, `ot`.`increment_id`, GROUP_CONCAT(ot.state) AS `status` FROM `wk_my_table_join_test` AS `main_table` INNER JOIN `wk_sales_order` AS `ot` ON main_table.order_id = ot.entity_id WHERE (status = 'pending') GROUP BY `main_table`.`order_id`

        MULTIPLE TABLE:

        $joinCollection = $this->_joinFactory->create();
        $joinCollection
        ->getSelect()
        ->join(
            ['ot'=>$orderTable],
            "main_table.order_id = ot.entity_id",
            [
                'increment_id' => 'ot.increment_id',
                'status' => 'GROUP_CONCAT(DISTINCT ot.state)'
            ]
        )
        ->join(
            ['ct' => $customerTable],
            "main_table.customer_id = ct.entity_id",
            [
                "customer_name" => "ct.firstname"
            ]
        )
        ->group("main_table.order_id");

        SELECT `main_table`.*, `ot`.`increment_id`, GROUP_CONCAT(DISTINCT ot.state) AS `status`, `ct`.`firstname` AS `customer_name` FROM `wk_my_table_join_test` AS `main_table` INNER JOIN `wk_sales_order` AS `ot` ON main_table.order_id = ot.entity_id INNER JOIN `wk_customer_entity` AS `ct` ON main_table.customer_id = ct.entity_id GROUP BY `main_table`.`order_id`;

2. How to filter by attribute:

    addAttributeToFilter();

    $_products->addAttributeToFilter('status', array('eq' => 1)); // Using the operator
    $_products->addAttributeToFilter('status', 1); // Without using the operator

    Not Equals - neq:

    $_products->addAttributeToFilter('sku', array('neq' => 'test-product'));

    Like - like:

    $_products->addAttributeToFilter('sku', array('like' => 'UX%'));

    Not Like - nlike:

    $_products->addAttributeToFilter('sku', array('nlike' => 'err-prod%'));

    More in: https://fishpig.co.uk/magento/tutorials/addattributetofilter/

    By nomal field:
    $productCollection = Mage::getModel('catalog/product')
    ->getCollection();

    $table = Mage::getSingleton('eav/config')->getAttribute('catalog_product', 'my_attribute')->getBackend()->getTable();
    $attributeId = Mage::getSingleton('eav/config')->getAttribute('catalog_product', 'my_attribute')->getAttributeId();

    $productCollection->getSelect()->join(array('attributeTable' => $table), 'e.entity_id = attributeTable.entity_id', array('my_attribute' => 'attributeTable.value'))
                                ->where("attributeTable.attribute_id = ?", $attributeId)
                                ->where("attributeTable.value = ?", 1);


    Add to collection:
    -Rewrite the the collection class.
    -addAttributeToSelect()

    collections = Mage::getModel('catalog/product')
       ->getCollection()
       ->addAttributeToSelect(array('name', 'price','sku'));
    
    -addFieldToFilter()
    $collection = Mage::getModel('catalog/product')->getCollection();
    $collection->addFieldToFilter(array(array('attribute' => 'name', 'like' => '%qwerty%')));
    $collection->addFieldToFilter(array(array('attribute' => 'description', 'like' => '%xyz%')));
    $collection->load(true);

3. How to get data from request (get/post) in correct way in magento 2.

    - Get Params
    protected $request;
    public function __construct(
        \Magento\Framework\App\Request\Http $request,
    ) {
       $this->request = $request;
    }

    public function getIddata()
    {
    $this->request->getParams();
        return $this->request->getParam('id');
    }

    - GetPost

    class ModelClassName 
    {
        protected $request;
        public function __construct(
            \Magento\Framework\App\Request\Http $request,
        ) {
        $this->request = $request;
        }
        public function getPost()
        {
            return $this->request->getPost();
        }
    }

4. How to validate form data with JS (client side) and PHP (server side) in Magento 2?

    From Client:
    - data-validate attribute
        <input id="field-1" ... data-validate='{"required":true}'/>
    - As an attribute
        <input id="field-1" ... required="true"/>
    - A class name
        <input id="field-1" ... class="input-text required-entry"/>
    - Using data-mage-init
        <form ... data-mage-init='{"validation": {"rules": {"field-1": {"required":true}}}}'>
            ...
        </form>
    
    From Server:

        Add function in controller to validate

        private function validatedParams()
            {
                $request = $this->getRequest();
                if (trim($request->getParam('first_name')) === '') {
                    throw new LocalizedException(__('First Name is missing'));
                }

                if (trim($request->getParam('last_name')) === '') {
                    throw new LocalizedException(__('Last Name is missing'));
                }

                if (false === \strpos($request->getParam('email'), '@')) {
                    throw new LocalizedException(__('Invalid email address'));
                }
                //Add your more validations here
                return $request->getParams();
            }


6.  What is VirtualType in di.xml?

A virtual type allows you to change the arguments of a specific injectable dependency and change the behavior of a particular class. This allows you to use a customized class without affecting other classes that have a dependency on the original.


7. What is the difference between custom EAV attributes and extension attributes ?

    - Custom and EAV (Entity-Attribute-Value) attributes. Custom attributes are those added on behalf of a merchant. For example, a merchant might need to add attributes to describe products, such as shape or volume. A merchant can add these attributes on the admin panel, and these attributes can be displayed.
    
    - Extension attributes. Extension attributes are new in Magento 2. They are used to extend functionality and often use more complex data types than custom attributes. These attributes do not appear on the GUI.

    More: http://www.weicot.com/dev/guides/v2.0/extension-dev-guide/attributes.html

8.  How to customize UI component template?


UPDATE QUERY: https://github.com/daipham31/open-training.git
