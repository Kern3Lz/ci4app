<?php

namespace App\Controllers;

use App\Models\OrangModel;
use CodeIgniter\Validation\Rules;

class Orang extends BaseController
{
    protected $orangModel;
    public function __construct()
    {
        $this->orangModel = new OrangModel();
    }
    public function index()
    {
        //$orang = $this->orangModel->findAll();

        // jika current page tidak ditemukan, maka akan diarahkan ke halaman pertama, jadi jika currentPage tidak mempunyai nilai, maka akan diisi dengan 1. Jika angkanya ada maka, currentPage akan diisi dengan angkanya.
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

        // mengatur jumlah data yang akan ditampilkan per halaman
        $baris = 6;

        // membuat search keyword

        // dengan Github Co-Pilot
        // $keyword = $this->request->getVar('keyword') ? $this->request->getVar('keyword') : '';

        // cara WPU
        $search = $this->request->getVar('search');
        if ($search) {
            $orang = $this->orangModel->search($search);
        } else {
            $orang = $this->orangModel->search('');
        }

        $data = [
            'title' => 'Daftar Orang | CI 4 Application',
            // 'orang' => $this->orangModel->findAll()

            // membuat pagination
            'orang' => $orang->paginate($baris, 'orang'),
            'pager' => $this->orangModel->pager,
            // 'currentPage' => $currentPage,
            'currentPage' => $currentPage,
            'baris' => $baris,
            'search' => $search
        ];

        return view('orang/index', $data);

        // cara konek db tanpa model
        // $db = \Config\Database::connect();
        // $orang = $db->query("SELECT * FROM orang");
        // foreach ($orang->getResultArray() as $row) {
        //     d($row);
        // }

        // cara konek db dengan model
        // $orangModel = new \App\Models\OrangModel();
        //$orangModel = new OrangModel();
        //dd($orang);


    }

    public function edit($id)
    {
        $orang = $this->request->getVar('id');
        $data = [
            'title' => 'Ubah Orang | CI 4 Application',
            'validation' => \Config\Services::validation(),
            'orang' => $this->orangModel->getOrang($id)
        ];
        return view('orang/edit', $data);
    }

    public function update($id)
    {
        $orang = $this->request->getVar('id');
        $data = [
            'title' => 'Ubah Orang | CI 4 Application',
            'validation' => \Config\Services::validation(),
            'orang' => $this->orangModel->getOrang($id)
        ];

        $this->orangModel->save([
            //'nama_column' => $this->request->getVar('name di form')'),
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
        ]);

        // set flash data
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to('/orang');
    }

    public function delete($id)
    {
        // $orang = $this->orangModel->find($id);
        // // $data = [
        // //     'title' => 'Hapus Orang | CI 4 Application',
        // //     'validation' => \Config\Services::validation(),
        // //     'orang' => $this->orangModel->getOrang($id)
        // // ];
        // // $this->orangModel->delete($id);
        // // // set flash data
        // // session()->setFlashdata('success', 'Data berhasil dihapus');
        // // return redirect()->to('/orang');

        // // make delete method
        // $this->orangModel->delete($id);
        // // set flash data
        // session()->setFlashdata('success', 'Data berhasil dihapus');
        // return redirect()->to('/orang');

        // make delete data
        $this->orangModel->delete($id);
        // set flash data
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/orang');
    }
}
