<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        //$komik = $this->komikModel->findAll();

        $data = [
            'title' => 'Daftar Komik | CI 4 Application',
            'komik' => $this->komikModel->getKomik()
        ];

        // cara konek db tanpa model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // foreach ($komik->getResultArray() as $row) {
        //     d($row);
        // }

        // cara konek db dengan model
        // $komikModel = new \App\Models\KomikModel();
        //$komikModel = new KomikModel();
        //dd($komik);


        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        // $komik = $this->komikModel->getKomik($slug);
        $data = [
            'title' => 'Detail Komik | CI 4 Application',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        // jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' tidak ditemukan');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik | CI 4 Application'
        ];
        return view('komik/create', $data);
    }

    public function save()
    {
        // getVar berfungsi untuk mengambil data dari form (get bisa post juga bisa)
        // dd($this->request->getVar());

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            //'nama_column' => $this->request->getVar('name di form')'),
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        return redirect()->to('/komik');
    }
}
