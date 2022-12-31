<?php
class Order extends CI_Controller
{
    function index()
    {
        $this->load->model('Order_model');        
        $this->load->model('OrderLine_model');
        $this->load->model('Product_model');
        $orders = $this->Order_model->getOrders();
        $orderlines = $this->OrderLine_model->getOrderLines();
        //echo '<script>console.log("'$orderlines . "\n" . $orderlines'"); </script>';
        //print_r($orderlines);
        $orderDetails=array();
        function filter_orderLines($orderId,$orderLine)
        {
            return ($orderId==$orderLine->order_id);
        }
        foreach ($orders as $order) {
           $filteredOls = array_filter($orderlines,function($elem) use($order){
                //print_r($elem);
                return $elem['order_id'] == $order['id'];
            });
           foreach($filteredOls as $ol){
            $orderDetailEntry= array();
            $orderDetailEntry['orderLineId']=$ol['id'];
            $orderDetailEntry['productId']=$ol['product_id'];
            $product = $this->Product_model->getProductById($ol['product_id']);
            $orderDetailEntry['productName']=$product['name'];
            $orderDetailEntry['id']=$order['id'];
            array_push($orderDetails,$orderDetailEntry);
           }
          
        }
        print_r($orderDetails);
        $data['orders'] = $orderDetails;
        $this->load->view('order', $data);
    }
    function addOrderScreen()
    {
        $this->load->view('addOrder');
    }
    /*
    public function addNewProduct()
    {
        $this->load->model('Product_model');
        $formArray = array();
        $formArray['name'] = $this->input->post('productName');
        $formArray['quantity'] = $this->input->post('totalStock');
        $formArray['unit_price'] = $this->input->post('unitPrice');
        $this->Product_model->addUser($formArray);
        $this->session->set_flashdata('success', 'Record Successfully save');
        redirect(base_url() . 'product');
    } */
    /* 
    function showEdit($subjectId)
    {
        $this->load->model('Subject_model');
        $formArray = array();
        $formArray['subjectName'] = $this->input->post('subjectName');
        $formArray['totalMarks'] = $this->input->post('subjectMarks');

        $formArray['classId'] = $this->input->post('class');
        $formArray['teacherId'] = $this->input->post('teacher');;
        $this->Subject_model->updateSubject($subjectId, $formArray);
        $this->session->set_flashdata('success', 'Record Successfully save');
        redirect(base_url() . 'Subject');
    }
    function edit($subjectId)
    {
        $this->load->model('Subject_model');
        $subject = $this->Subject_model->editSubject($subjectId);
        $data = array();
        $data['subject'] = $subject;
        $this->load->view('editSubject', $data);
    }
    function delete($subjectId)
    {
        $this->load->model("Subject_model");
        $subject = $this->Subject_model->editSubject($subjectId);
        if (!empty($subject)) {
            $this->Subject_model->delete($subjectId);
            redirect(base_url() . 'Subject');
        }
    } 
    */
}
