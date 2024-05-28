<?php

namespace App\Controllers;

use App\Models\ProdiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Prodi extends BaseController
{
    protected $prodiModel;

    public function __construct()
    {
       
        // Inisialisasi model di dalam konstruktor
        $this->prodiModel = new ProdiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Prodi',
            'prodi' => $this->prodiModel->findAll()
        ];

        // Mengirim data ke view
        return view('prodi/index', $data);
    }

    public function create()
{
    // Validasi input
    if ($this->request->getMethod() === 'post' && $this->validate([
        'nama_prodi' => 'required'
    ])) {
        $this->prodiModel->save([
            'nama_prodi' => $this->request->getPost('nama_prodi')
        ]);

        // Set notifikasi flash dengan session
        session()->setFlashdata('success', 'Data prodi berhasil ditambahkan.');
        return redirect()->to('/prodi');
    }

    // Jika validasi gagal atau request bukan POST
    session()->setFlashdata('error', 'Gagal menambahkan data prodi.');
    return redirect()->to('/prodi');
}


  public function ubah($id)
    {
        $prodi = $this->prodiModel->find($id);

        if (!$prodi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Prodi tidak ditemukan');
        }

        // Jika form disubmit dengan metode POST
        if ($this->request->getMethod() === 'post') {
            // Validasi input
            if ($this->validate([
                'nama_prodi' => 'required'
            ])) {
                $this->prodiModel->update($id, [
                    'nama_prodi' => $this->request->getPost('nama_prodi')
                ]);

                session()->setFlashdata('success', 'Berhasil mengedit data Prodi.');
                return redirect()->to('/prodi');
            } else {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->to('/prodi/ubah/' . $id);
            }
        }

        // Kirim data prodi ke view
        $data = [
            'title' => 'nama_prodi',
            'prodi' => $prodi
        ];

        return view('prodi/edit', $data);
    }


 public function delete($id)
{
    // Hapus data prodi berdasarkan ID
    $this->prodiModel->delete($id);

    // Set pesan flash untuk memberitahu pengguna bahwa data telah dihapus
    session()->setFlashdata('success', 'Berhasil menghapus data Prodi.');

    // Redirect kembali ke halaman indeks
    return redirect()->to('/prodi');
}
}
