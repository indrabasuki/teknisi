<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->form_validation->set_error_delimiters('', '');
		$this->load->model('Teknisi_model', 'teknisi');
	}

	public function index()
	{
		$this->template->app('teknisi/data', 'Teknisi');
	}

	public function map()
	{
		$this->template->app('teknisi/map', 'Teknisi');
	}

	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

	public function datatable()
	{
		$this->output_json($this->teknisi->getDatatables(), false);
	}

	public function get_data()
	{
		$data = $this->teknisi->get();
		echo json_encode($data);
	}

	public function get_list()
	{
		$data = $this->teknisi->get();
		echo json_encode($data);
	}
	public function get_id($id)
	{
		$data = $this->teknisi->getId($id);
		echo json_encode($data);
	}


	public function add()
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => "Nama Lengkap Wajib Disii"]);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email|is_unique[teknisi.email]',
			[
				'required' => "Email  Wajib Disii",
				'valid_email' => "Email  Tidak Valid",
				'is_unique' => "Email  Sudah Digunakan"
			]
		);
		$this->form_validation->set_rules(
			'telepon',
			'Nomor Hp',
			'required|trim|is_unique[teknisi.telepon]',
			[
				'required' => "Telepon Wajib Disii",
				'is_unique' => "Telepon Sudah Digunakan"
			]
		);
		$this->form_validation->set_rules(
			'tempat_lahir',
			'Nomor Hp',
			'required|trim',
			[
				'required' => "Tempat Lahir Wajib Disii",
			]
		);
		$this->form_validation->set_rules(
			'alamat',
			'Alamat',
			'required|trim',
			[
				'required' => "Alamat Wajib Disii",
			]
		);
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'status'	=> false,
				'errors'	=> [
					'nama' 				=> form_error('nama',),
					'email' 			=> form_error('email'),
					'tempat_lahir' 		=> form_error('tempat_lahir'),
					'telepon' 			=> form_error('telepon'),
				]
			];
			$this->output_json($data);
		} else {
			$data = [
				'nama' 				=> $this->input->post('nama'),
				'email' 			=> $this->input->post('email'),
				'tempat_lahir' 		=> $this->input->post('tempat_lahir'),
				'tanggal_lahir' 	=> $this->input->post('tanggal_lahir'),
				'telepon' 			=> $this->input->post('telepon'),
				'alamat' 			=> $this->input->post('alamat'),
				'lat' 				=> $this->input->post('lat'),
				'lon' 				=> $this->input->post('lon'),
			];
			$this->teknisi->insert($data);
			echo json_encode(["status" => TRUE, "message" => "Data Berhasil Di Simpan"]);
		}
	}

	public function update()
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => "Nama Lengkap Wajib Disii"]);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			[
				'required' => "Email  Wajib Disii",
				'valid_email' => "Email  Tidak Valid"
			]
		);
		$this->form_validation->set_rules(
			'telepon',
			'Nomor Hp',
			'required|trim',
			[
				'required' => "Telepon Wajib Disii",
			]
		);
		$this->form_validation->set_rules(
			'tempat_lahir',
			'Nomor Hp',
			'required|trim',
			[
				'required' => "Tempat Lahir Wajib Disii",
			]
		);
		$this->form_validation->set_rules(
			'alamat',
			'Alamat',
			'required|trim',
			[
				'required' => "Alamat Wajib Disii",
			]
		);
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'status'	=> false,
				'errors'	=> [
					'nama' 				=> form_error('nama',),
					'email' 			=> form_error('email'),
					'tempat_lahir' 		=> form_error('tempat_lahir'),
					'telepon' 			=> form_error('telepon'),
				]
			];
			$this->output_json($data);
		} else {
			$data = [
				'nama' 				=> $this->input->post('nama'),
				'email' 			=> $this->input->post('email'),
				'tempat_lahir' 		=> $this->input->post('tempat_lahir'),
				'tanggal_lahir' 	=> $this->input->post('tanggal_lahir'),
				'telepon' 			=> $this->input->post('telepon'),
				'alamat' 			=> $this->input->post('alamat'),
				'lat'	 			=> $this->input->post('lat'),
				'lon' 				=> $this->input->post('lon'),
			];
			$this->teknisi->update(['id' => $this->input->post('id')], $data);
			echo json_encode(["status" => TRUE, "message" => "Data Berhasil Di Update"]);
		}
	}

	public function delete($id)
	{
		$this->teknisi->delete($id);
		echo json_encode(["status" => TRUE, "message" => "Data Berhasil Di Hapus"]);
	}
}
/* End of file: Teknisi.php */
