<?php

/**
 * Class News_model
 * @property CI_DB_driver|CI_DB_sqlite3_driver $db The DB driver
 */
class News_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_news_detail($id)
    {
        

        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }
    public function get_news($limit = 0, $start = 0, $search = '')
    {
        $this->db->like('title', $search);
        $this->db->or_like('text', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('news');
        return $query->result_array();
    }

    public function get_news_count($search = '')
    {
        $this->db->like('title', $search);
        $this->db->or_like('text', $search);
        return $this->db->count_all_results('news');
    }

    /**
     * @param string $title
     * @param string $text
     * @return mixed
     */
    public function set_news($title, $text)
    {
        $this->load->helper('url');

        $slug = url_title($title, 'dash', TRUE);

        $data = array(
            'title' => $title,
            'slug' => $slug,
            'text' => $text
        );

        return $this->db->insert('news', $data);
    }

    public function delete_news($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('news');
    }

     // Fetch news item by ID
    public function get_news_by_id($id)
    {
        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }

    // Update news item
    public function update_news($id, $data)
    {
        // Ensure only relevant fields are being updated
        $update_data = array(
            'title' => $data['title'],
            'text'  => $data['text']
        );

        // Perform the update query
        $this->db->where('id', $id);
        return $this->db->update('news', $update_data);
    }

}
