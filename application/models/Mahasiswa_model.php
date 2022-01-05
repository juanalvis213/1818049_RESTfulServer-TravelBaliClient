<?php

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost/travel-bali/'
        ]);
    }

    public function getAllPantai()
    {

        $response = $this->_client->request('GET', 'Travel_bali');

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['message'];
    }

    public function getPantaiId($id)
    {
        $response = $this->_client->request('GET', 'Travel_bali', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['message'][$id];
    }

    public function tambahPantai()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "gambar" => $this->input->post('gambar', true),
            "alamat" => $this->input->post('alamat', true)
        ];

        $response = $this->_client->request('POST', 'Travel_bali', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function hapusPantai($nama)
    {
        $response = $this->_client->delete('Travel_bali', [
            'form_params' => [
                'id' => $nama,
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataPantai()
    {
        $data = [
            "id" => $this->input->post('id', true),
            "nama" => $this->input->post('nama', true),
            "gambar" => $this->input->post('gambar', true),
            "alamat" => $this->input->post('alamat', true),

        ];

        $response = $this->_client->request('PUT', 'Travel_bali', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataMahasiswa()
    {
        // $keyword = $this->input->post('keyword', true);
        // $this->db->like('nama', $keyword);
        // $this->db->or_like('gambar', $keyword);
        // $this->db->or_like('alamat', $keyword);
        // return $this->db->get('mahasiswa')->result_array();
        return false;
    }
}
