<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi_model extends CI_Model
{

    protected $table = 'teknisi';
    public function getDatatables()
    {
        $this->datatables->select('id,nama,email,telepon,alamat');
        $this->datatables->from($this->table);
        return $this->datatables->generate();
    }
    public function get()
    {
        return $this->db->get($this->table)->result();
    }

    public function getId($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}

/* End of file: Teknisi_model.php */
