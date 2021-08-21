<?php

namespace App\Controllers;

use App\Models\Barang_model;
use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class Barang extends ResourceController
{

    public function __construct()
    {
        $this->barang = new Barang_model();
    }

	public function index()
	{
		$barang = $this->barang->getBarang();

        foreach($barang as $brg){
            $barang_all[] = [
                'id' => intval($brg['id']),
                'foto_barang' => $brg['foto_barang'],
                'nama_barang' => $brg['nama_barang'],
                'kategori' => $brg['kategori'],
                'harga' => $brg['harga'],
                'diskon' => $brg['diskon']
            ];
        }
        return $this->respond($barang_all, 200);
	}

    public function create()
    {
        $foto_barang = $this->request->getPost('foto_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $kategori = $this->request->getPost('kategori');
        $harga = $this->request->getPost('harga');
        // $diskon = $this->request->getPost('diskon');

        if($harga >= 40000){
            $diskon = $harga*(10/100);
        }else{
            $diskon = 0;
        }

        $data = [
            'foto_barang' => $foto_barang,
            'nama_barang' => $nama_barang,
            'kategori' => $kategori,
            'harga' => $harga,
            'diskon' => $diskon
        ];

        $simpan = $this->barang->insertBarang($data);

        if($simpan == true){
            $output = [
                'status' => 200,
                'message' => 'Berhasil Menyimpan Data',
                'data' => ''
            ];
            return $this->respond($output, 200);
        }else{
            $output = [
                'status' => 400,
                'message' => 'Gagal Menyimpan Data Menyimpan Data',
                'data' => ''
            ];
            return $this->respond($output, 400);
        }
    }

    public function show($id = null)
    {
        $barang = $this->barang->getBarang($id);
        
        if(!empty($barang)){

            $output = [
                'id' => intval($barang['id']),
                'foto_barang' => $barang['foto_barang'],
                'nama_barang' => $barang['nama_barang'],
                'kategori' => $barang['kategori'],
                'harga' => $barang['harga'],
                'diskon' => $barang['diskon']
            ];
            return $this->respond($output, 200);
        }else{
            $output = [
                'status' => 400,
                'message' => 'Gagal Menemukan Data',
                'data' => ''
            ];
            return $this->respond($output, 400);
        }
    }

    public function edit($id = null)
    {
        $barang = $this->barang->getBarang($id);
        
        if(!empty($barang)){

            $output = [
                'id' => intval($barang['id']),
                'foto_barang' => $barang['foto_barang'],
                'nama_barang' => $barang['nama_barang'],
                'kategori' => $barang['kategori'],
                'harga' => $barang['harga'],
                'diskon' => $barang['diskon']
            ];
            return $this->respond($output, 200);
        }else{
            $output = [
                'status' => 400,
                'message' => 'Gagal Menemukan Data',
                'data' => ''
            ];
            return $this->respond($output, 400);
        }
    }

    public function update($id = null)
    {

        // $foto_barang = $this->request->getRawInput('foto_barang');
        // $nama_barang = $this->request->getRawInput('nama_barang');
        // $kategori = $this->request->getRawInput('kategori');
        // $harga = $this->request->getRawInput('harga');
        // $diskon = $this->request->getPost('diskon');

        // if($harga >= 40000){
        //     $diskon = $harga * (10/100);
        // }else{
        //     $diskon == $harga;
        // }

        // $data = [
        //     'foto_barang' => $foto_barang,
        //     'nama_barang' => $nama_barang,
        //     'kategori' => $kategori,
        //     'harga' => $harga,
        //     'diskon' => $diskon
        // ];



        // Menangkap data dari method PUT, DELETE, PATCH
        $data = $this->request->getRawInput();

        // $dataa = [
        //     'harga' => $data['harga']
        // ];

        // Cek data barang berdasarkan id
        $barang = $this->barang->getBarang($id);

        if(!empty($barang)){

            $updateBarang = $this->barang->updateBarang($data, $id);
            
            $output = [
                'status' => true,
                'data' => '',
                'message' => 'Berhasil Update'
            ];
            return $this->respond($output, 200);
        }else{
            $output = [
                'status' => false,
                'data' => '',
                'message' => 'Gagal Update'
            ];
            return $this->respond($output, 400);
        }

    }

    public function delete($id = null)
    {

        // Cek data barang berdasarkan id
        $barang = $this->barang->getBarang($id);

        if(!empty($barang)){

            $deleteBarang = $this->barang->deleteBarang($id);
            
            $output = [
                'status' => true,
                'data' => '',
                'message' => 'Berhasil Hapus'
            ];
            return $this->respond($output, 200);
        }else{
            $output = [
                'status' => false,
                'data' => '',
                'message' => 'Gagal Hapus'
            ];
            return $this->respond($output, 400);
        }

    }
}
