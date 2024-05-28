<?php

namespace App\Controllers;

use App\Models\DivisiModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Divisi extends BaseController
{
    protected $divisiModel;

    public function __construct()
    {
        // Inisialisasi model di dalam konstruktor
        $this->divisiModel = new DivisiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Divisi',
            'divisi' => $this->divisiModel->findAll()
        ];

        // Mengirim data ke view
        return view('divisi/index', $data);
    }

    public function create()
    {
        // Validasi input
        if ($this->request->getMethod() === 'post' && $this->validate([
            'nama_divisi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg]|max_size[foto,2048]'
        ])) {
            // Mengambil file yang diupload
            $fileFoto = $this->request->getFile('foto');
            
            // Generate nama file baru
            $namaFoto = $fileFoto->getRandomName();
            
            // Pindahkan file ke folder uploads/foto_divisi
            $fileFoto->move('uploads/foto_divisi', $namaFoto);

            // Menyimpan data baru
            $this->divisiModel->save([
                'nama_divisi' => $this->request->getPost('nama_divisi'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'foto' => $namaFoto
            ]);

            // Menampilkan pesan sukses
            session()->setFlashdata('success', 'Data divisi berhasil ditambahkan.');
            return redirect()->to('/divisi');
        }

        // Menampilkan pesan error
        session()->setFlashdata('error', 'Gagal menambahkan data divisi. Pastikan semua data terisi dengan benar.');
        return redirect()->back()->withInput();
    }

    public function delete($id)
    {
        // Memeriksa apakah data divisi dengan ID yang diberikan ada
        $divisi = $this->divisiModel->find($id);
        if (!$divisi) {
            throw new PageNotFoundException('Data divisi dengan ID ' . $id . ' tidak ditemukan.');
        }

        // Menghapus file foto
        if ($divisi['foto']) {
            unlink('uploads/foto_divisi/' . $divisi['foto']);
        }

        // Menghapus data divisi
        $this->divisiModel->delete($id);

        // Menampilkan pesan sukses
        session()->setFlashdata('success', 'Data divisi berhasil dihapus.');
        return redirect()->to('/divisi');
    }

    public function edit($id)
    {
        // Memeriksa apakah data divisi dengan ID yang diberikan ada
        $divisi = $this->divisiModel->find($id);
        if (!$divisi) {
            throw new PageNotFoundException('Data divisi dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Data Divisi',
            'divisi' => $divisi
        ];

        // Mengirim data ke view
        return view('divisi/edit', $data);
    }

    public function update($id)
    {
        // Validasi input
        if ($this->request->getMethod() === 'post' && $this->validate([
            'nama_divisi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'mime_in[foto,image/jpg,image/jpeg]|max_size[foto,2048]'
        ])) {
            $fileFoto = $this->request->getFile('foto');
            $divisi = $this->divisiModel->find($id);

            if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
                // Generate nama file baru
                $namaFoto = $fileFoto->getRandomName();
                
                // Pindahkan file ke folder uploads/foto_divisi
                $fileFoto->move('uploads/foto_divisi', $namaFoto);
                
                // Hapus foto lama jika ada
                if ($divisi['foto']) {
                    unlink('uploads/foto_divisi/' . $divisi['foto']);
                }
            } else {
                // Jika tidak ada file baru, gunakan foto lama
                $namaFoto = $divisi['foto'];
            }

            // Memperbarui data divisi
            $this->divisiModel->update($id, [
                'nama_divisi' => $this->request->getPost('nama_divisi'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'foto' => $namaFoto
            ]);

            // Menampilkan pesan sukses
            session()->setFlashdata('success', 'Data divisi berhasil diperbarui.');
            return redirect()->to('/divisi');
        }

        // Menampilkan pesan error
        session()->setFlashdata('error', 'Gagal memperbarui data divisi. Pastikan semua data terisi dengan benar.');
        return redirect()->back()->withInput();
    }
}
