<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
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
            "pageTitle" => "Data Services",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header', $push);
        $this->load->view('services', $push);
        $this->load->view('footer', $push);
    }

    public function json()
    {
        $this->load->model("datatables");
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<index>',
            '<get-name>',
            '[rupiah=<get-price>]',
            '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-name="<get-name>" data-price="<get-price>"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>"><i class="fa fa-trash"></i></button></div>'
        ]);
        $this->datatables->setOrdering(["id", "name", NULL, NULL, NULL, "price", NULL]);
        $this->datatables->setWhere("type", "service");
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
        $price = $this->input->post("price");

        if (!$name or !$price) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {
            $insertData = [
                "id" => NULL,
                "name" => $name,
                "motor" => NULL,
                "kodepart" => NULL,
                "jenisbarang" => NULL,
                "price" => $price,
                "type" => "service",
                "stock" => NULL
            ];

            $response['status'] = TRUE;

            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->product_model->post($insertData);
            } else {
                unset($insertData['id']);
                unset($insertData['motor']);
                unset($insertData['kodepart']);
                unset($insertData['jenisbarang']);
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
