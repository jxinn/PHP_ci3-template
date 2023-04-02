<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User model.
 */
class User_model extends CI_Model 
{
// ------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }
// ------------------------------------------------------------------------
    /**
     * Get one user by email.
     *
     * @param string $email User email.
     *
     * @return ?array
     */
    public function selectUserByEmail(string $email): ?array
    {
        $query = "SELECT * FROM `user` WHERE email = ?";
        $result = $this->db->query($query, [
            'email' => $email,
        ]);

        $error = $this->db->error();
        if ($error['code'] > 0) {
            log_message('error', 'Method: '.__method__.', Query error: '.$error['message'].' - Invalid query: '.$query);
            return null;
        }

        return $result->row_array();
    }
// ------------------------------------------------------------------------
    /**
     * Get user list.
     *
     * @param array $data   Binding data.
     * $data = []
     * @param array $params Add Params.
     * $params = [
     *     'current_page' => (int)    Current page. optional.
     *     'page_rows'    => (int)    Page rows. optional.
     *     'email'        => (string) User email. optional.
     * ]
     *
     * @return array
     */
    public function selectUserList($data, $params): array
    {
        $merge_data  = [];
        $where_query = $limit_query = "";
        $column      = "*";
        $sort_query = " ORDER BY id DESC ";

        if (isset($params['email'])) {
            array_push($merge_data, '%' . $params['email'] . '%');
            $where_query .= " AND email LIKE ?";
        }

        $sql = "SELECT COUNT(*) AS CNT FROM `user` WHERE (1)" . $where_query;
        $data  = array_merge($data, $merge_data);
        $query = $this->db->query($sql, $data);
        $error = $this->db->error();

        if ($error['code'] > 0) {
            log_message('error', 'Method: ' . __method__ . ', Query error: ' . $error['message'] . ' - Invalid query: ' . $query);
            return [];
        }

        $row         = $query->row_array();
        $total_count = $row['CNT'];

        if (isset($params['current_page']) && isset($params['page_rows'])) {
            $limit_query = " LIMIT ?, ?";
            array_push($data, ($params['current_page'] - 1) * $params['page_rows'], $params['page_rows']);
        }

        $sql   = str_replace("COUNT(*) AS CNT", $column, $sql) . $sort_query . $limit_query;
        $query = $this->db->query($sql, $data);
        $error = $this->db->error();

        if ($error['code'] > 0) {
            log_message('error', 'Method: ' . __method__ . ', Query error: ' . $error['message'] . ' - Invalid query: ' . $query);
            return [];
        }

        return [
            'list'        => $query->result_array(),
            'total_count' => $total_count,
        ];
    }
// ------------------------------------------------------------------------
    /**
     * Add user.
     *
     * @param array $data Binding data.
     * $data = [
     *     'email'    => (string) Email.
     *     'password' => (string) Password.
     * ]
     * @return int | bool
     */
    public function insertItem(array $data)
    {
        $query = "INSERT INTO `user` (`email`, `password`)
            VALUES (?, ?)";
        $this->db->query($query, $data);

        $error = $this->db->error();
        if ($error['code'] > 0) {
            log_message('error', 'Method: '.__method__.', Query error: '.$error['message'].' - Invalid query: '.$query);
            return null;
        }
         
        return $this->db->insert_id();
    }
// ------------------------------------------------------------------------
}