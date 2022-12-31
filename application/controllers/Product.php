<?php
class Product extends CI_Controller
{
    function index()
    {
        $this->load->model('Product_model');
        $subjects = $this->Product_model->getProducts();
        $data['products'] = $subjects;
        $this->load->view('product', $data);
    }
    function addProductScreen()
    {
        $this->load->view('addProduct');
    }
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
    }
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
