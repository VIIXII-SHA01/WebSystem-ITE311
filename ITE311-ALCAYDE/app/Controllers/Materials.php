<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use CodeIgniter\Controller;

class Materials extends Controller
{
    protected $materialModel;

    public function __construct()
    {
        $this->materialModel = new MaterialModel();
        helper(['form', 'url', 'download']);
    }

    public function upload()
    {
        $session = session();
        $data = [];

        if ($this->request->is('post')) {
            $file = $this->request->getFile('material_file');

            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads', $newName);

                $this->materialModel->insertMaterial([
                    'file_name' => $file->getClientName(),
                    'file_path' => WRITEPATH . 'uploads/' . $newName,
                ]);

                $session->setFlashdata('success', 'File uploaded successfully');
                return redirect()->to("/teacher/course/");
            } else {
                $session->setFlashdata('error', 'File upload failed');
            }
        }

        echo view('admin/upload', $data);
    }

    public function delete($material_id)
    {
        $material = $this->materialModel->find($material_id);

        if ($material) {
            if (file_exists($material['file_path'])) {
                unlink($material['file_path']);
            }
            $this->materialModel->delete($material_id);
        }

        return redirect()->back();
    }

    public function download($material_id)
    {
        $material = $this->materialModel->find($material_id);

        if (!$material) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Material not found');
        }

        return $this->response->download($material['file_path'], null);
    }
}
