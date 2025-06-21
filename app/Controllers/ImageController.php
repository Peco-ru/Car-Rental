<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ImageModel;
use CodeIgniter\HTTP\ResponseInterface;

class ImageController extends BaseController
{
    public function index()
    {
        //
    }
     
    public function dashboard()
{
    $model = model(ImageModel::class);
    $uploadedImage = $model->getLatestImageForUser(session()->get('user_id'));

    return view('pages/dashboard', ['uploadedImage' => $uploadedImage]);
}


public function uploadImage()
    {
        helper('form');

        $valid = $this->validateData([], [
        'car_image' => [
            'uploaded[car_image]',
            'is_image[car_image]',
            'max_size[car_image,2048]',
        ],
        ]);

        if (!$valid) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('car_image');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $name);



            // Store to DB
            model(ImageModel::class)->insert([
                'user_id'        => session()->get('user_id'),
                'image_filename' => $name,
                'created_at'     => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to('/admindashboard');
    }

    public function serveImage($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $file = new File($path);
        return $this->response->setHeader('Content-Type', $file->getMimeType())
                               ->setHeader('Content-Length', $file->getSize())
                               ->setBody(file_get_contents($path));
    }


}
