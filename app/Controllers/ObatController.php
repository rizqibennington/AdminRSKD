<?php

namespace App\Controllers;

use App\Models\ObatModel;

class ObatController extends BaseController
{
    protected $obat;

    function __construct()
    {
        $this->obat = new ObatModel();
        ini_set('display_errors', 1);
    }

    public function index()
    {
        $data['obat'] = $this->obat->findAll();

        return view('obat/index', $data);
    }

    public function create()
    {
        $file = $this->request->getFile('upload');
        // print_r($file);
        // exit();

        if ($file->isValid() && !$file->hasMoved()) {
            if ($file->getSize() <= 5 * 1024 * 1024) { // 5 MB in bytes
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads', $newName);


                $filepath =  $newName;

                $this->obat->insert([
                    'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                    'nama_obat' => $this->request->getPost('nama_obat'),
                    'bentuk' => $this->request->getPost('bentuk'),
                    'tujuan' => $this->request->getPost('tujuan'),
                    'uraian' => $this->request->getPost('uraian'),
                    'filepath' => $filepath,
                ]);

                return redirect()->to('obat')->with('success', 'Data Added Successfully');
            } else {
                return redirect()->to('obat')->with('error', 'File size exceeds 5 MB');
            }
        } else {
            return redirect()->to('obat')->with('error', 'File upload failed');
        }
    }

    public function download($filename)
    {
        $filePath = WRITEPATH . 'uploads/' . $filename;

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            return "File not found.";
        }
    }

    public function edit($id)
    {
        $file = $this->request->getFile('upload');
        $updateData = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'nama_obat' => $this->request->getPost('nama_obat'),
            'bentuk' => $this->request->getPost('bentuk'),
            'tujuan' => $this->request->getPost('tujuan'),
            'uraian' => $this->request->getPost('uraian'),
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($file->getSize() <= 5 * 1024 * 1024) { // 5 MB in bytes
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads', $newName);
                $updateData['filepath'] = $newName;
            } else {
                return redirect()->to('obat')->with('error', 'File size exceeds 5 MB');
            }
        }

        $this->obat->update($id, $updateData);

        return redirect()->to('obat')->with('success', 'Data Updated Successfully');
    }

    public function verifikasi($id)
    {
        $this->obat->update($id, ['status' => 1]);
        return redirect()->to('obat')->with('success', 'Status updated to Verifikasi');
    }

    public function tolak($id)
    {
        $this->obat->update($id, ['status' => 2]);
        return redirect()->to('obat')->with('success', 'Status updated to Tolak');
    }
    public function delete($id)
    {
        // Check if the ID is valid
        if (!is_numeric($id)) {
            return redirect()->to('obat')->with('error', 'Invalid ID');
        }

        // Find the record with the given ID
        $obat = $this->obat->find($id);

        // Check if the record exists
        if (!$obat) {
            return redirect()->to('obat')->with('error', 'Record not found');
        }

        // Delete the record
        $this->obat->delete($id);

        // Redirect with success message
        return redirect()->to('obat')->with('success', 'Data Deleted Successfully');
    }
}
