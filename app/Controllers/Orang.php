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
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $orang = $this->orangModel->search($keyword);
        } else {
            $orang = $this->orangModel;
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
}
