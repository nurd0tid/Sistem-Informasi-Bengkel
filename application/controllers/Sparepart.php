<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sparepart extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("product_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Sparepart",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header', $push);
        $this->load->view('sparepart', $push);
        $this->load->view('footer', $push);
    }

    public function json()
    {
        $this->load->model("datatables");
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<index>',
            '<get-name>',
            '<get-motor>',
            '<get-kodepart>',
            '<get-jenisbarang>',
            '[rupiah=<get-price>]',
            '<get-stock>',
            '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-name="<get-name>"  data-motor="<get-motor>" data-kodepart="<get-kodepart>" data-jenisbarang="<get-jenisbarang>" data-price="<get-price>"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>"><i class="fa fa-trash"></i></button></div>'
        ]);
        $this->datatables->setOrdering(["id", "name", "motor", "kodepart", "jenisbarang", "price", "stock", NULL]);
        $this->datatables->setWhere("type", "sparepart");
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }

    function insert()
    {
        $this->process();
    }

    function update($id)
    {
        $this->process("edit", $id);
    }

    private function process($action = "add", $id = 0)
    {
        $name = $this->input->post("name");
        $motor = $this->input->post("motor");
        $kodepart = $this->input->post("kodepart");
        $jenisbarang = $this->input->post("jenisbarang");
        $price = $this->input->post("price");

        if (!$name or !$motor or !$kodepart or !$jenisbarang or !$price) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {
            $insertData = [
                "id" => NULL,
                "name" => $name,
                "motor" => $motor,
                "kodepart" => $kodepart,
                "jenisbarang" => $jenisbarang,
                "price" => $price,
                "type" => "sparepart",
                "stock" => 0
            ];

            $response['status'] = TRUE;

            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->product_model->post($insertData);
            } else {
                unset($insertData['id']);
                unset($insertData['type']);
                unset($insertData['stock']);

                $response['msg'] = "Data berhasil diedit";
                $this->product_model->put($id, $insertData);
            }
        }

        echo json_encode($response);
    }

    function delete($id)
    {
        $response = [
            'status' => FALSE,
            'msg' => "Data gagal dihapus"
        ];

        if ($this->product_model->delete($id)) {
            $response = [
                'status' => TRUE,
                'msg' => "Data berhasil dihapus"
            ];
        }

        echo json_encode($response);
    }
}
