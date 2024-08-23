<?php

/**
 * Class News
 * @property News_model $news_model The News model
 * @property CI_Form_validation $form_validation The form validation lib
 * @property CI_Input $input The input lib
 */
class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper('url_helper');
    }

   
    public function index()
    {
        $this->load->library('pagination');
        $this->load->helper('url');

        $search = $this->input->get('search', TRUE); // Get the search query
        $data['search'] = $search;

        // Pagination configuration
        $config['base_url'] = site_url();  // Base URL for pagination links
        $config['total_rows'] = $this->news_model->get_news_count($search); // Total rows count
        $config['per_page'] = 10; // Records per page
        $config['page_query_string'] = TRUE; // Enable query string pagination
        $config['query_string_segment'] = 'page'; // The query string key for pagination
        $config['use_page_numbers'] = TRUE; // Use page numbers instead of offset

        

        // Initialize pagination
        $this->pagination->initialize($config);

        // Get current page number from query string
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        // Calculate the offset
        $offset = ($page - 1) * $config['per_page'];

        // Fetch the news items
        $data['news'] = $this->news_model->get_news($config['per_page'], $offset, $search);

        // Page title
        $data['title'] = 'News archive';

        // Load the views
        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }


    public function view($id)
    {
        $data['news_item'] = $this->news_model->get_news_detail($id);
        
        if (empty($data['news_item']))
        {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->news_model->set_news($this->input->post_get('title', true), $this->input->post_get('text', true));
           
            $this->session->set_flashdata('success', 'News item created successfully!');
            redirect('/'); // Or redirect('/');
        }
    }

    public function delete($id)
    {
        $this->load->model('news_model');

        if (empty($id) || !is_numeric($id)) {
            show_404();
        }

        $deleted = $this->news_model->delete_news($id);

        if ($deleted) {
            $this->session->set_flashdata('success', 'News item deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete news item.');
        }

        redirect('/');
    }

    public function edit($id)
    {
        // Load the model
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->model('news_model');

        // Fetch the news item by ID
        $data['news_item'] = $this->news_model->get_news_by_id($id);

        // Check if the news item exists
        if (empty($data['news_item'])) {
            show_404(); // Show 404 page if the item does not exist
        }

        // Set page title
        $data['title'] = 'Edit News Item';

        // Load the views
        $this->load->view('templates/header', $data);
        $this->load->view('news/edit', $data);
        $this->load->view('templates/footer');
    }
    public function update()
    {
        // Load the model
        $this->load->model('news_model');
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        // Check if form validation passed
        if ($this->form_validation->run() === FALSE) {
            // Reload the edit form with validation errors
            $id = $this->input->post('id');
            $data['news_item'] = $this->news_model->get_news_by_id($id);
            $data['title'] = 'Edit News Item';

            $this->load->view('templates/header', $data);
            $this->load->view('news/edit', $data);
            $this->load->view('templates/footer');
        } else {
            // Update news item
            $id = $this->input->post('id');
            $this->news_model->update_news($id, $this->input->post());

            // Set a success message
            $this->session->set_flashdata('success', 'News item updated successfully.');

            // Redirect to the news index
            redirect('/');
        }
    }




}
