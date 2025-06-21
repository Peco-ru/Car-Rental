<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\UserRoleModel;
use App\Models\ImageModel;
use App\Models\RentalModel;
use App\Controllers\BaseController;

class PagesController extends BaseController
{
    public function index()
    {
        //
    }

    public function home()
    {
        return view('pages/home');
    }

    public function about()
    {
        return view('pages/about');
    }


   // Fix for dashboard user ID check
public function dashboard()
{
    $user_id = session()->get('user_id');
    if (!$user_id) {
        return redirect()->to('/login');
    }

    $userModel = new \App\Models\UserModel();
    $rentalModel = new \App\Models\RentalModel();

    // Get user info
    $user = $userModel->find($user_id);

    // Get latest rental (or all rentals if you want)
    $rental = $rentalModel
        ->select('rentals.*, car.car_name, car.car_model')
        ->join('car', 'car.id = rentals.car_id')
        ->where('rentals.user_id', $user_id)
        ->orderBy('rent_start', 'DESC')
        ->first();

    return view('pages/dashboard', [
        'user' => $user,
        'rental' => $rental,
    ]);
}





  public function submit()
{
    $user_id = session()->get('user_id');
    if (!$user_id) {
        return redirect()->to('/login');
    }

    // Get POST data
    $car_id = $this->request->getPost('car_id');
    $rent_start = $this->request->getPost('rent_start');
    $rent_end = $this->request->getPost('rent_end');

    // Validate dates (basic)
    if (!$car_id || !$rent_start || !$rent_end || strtotime($rent_end) <= strtotime($rent_start)) {
        return redirect()->back()->with('error', 'Invalid rental data.');
    }

    // Prepare rental data
    $rentalData = [
        'car_id' => $car_id,
        'rent_start' => $rent_start,
        'rent_end' => $rent_end,
    ];

    // Use RentalModel
    $rentalModel = new \App\Models\RentalModel();

    // Check if user already has a rental
    $existingRental = $rentalModel->where('user_id', $user_id)->first();

    if ($existingRental) {
        // Update the existing rental
        $rentalModel->update($existingRental['id'], $rentalData);
    } else {
        // Add user_id for new insert
        $rentalData['user_id'] = $user_id;

        if (!$rentalModel->insert($rentalData)) {
            $errors = $rentalModel->errors();
            dd($errors); // Dump errors for debugging
        }
    }

    return redirect()->to('/dashboard')->with('success', 'Car rented successfully!');
}





    
    public function Ford_Everest()
    {
        return view('Cars/Ford_Everest');
    }

    public function Nissan_Terra()
    {
        return view('Cars/Nissan_Terra');
    }

    public function Mitsubishi()
    {
        return view('Cars/Mitsubishi');
    }

    public function Toyota()
    {
        return view('Cars/Toyota');
    }

    public function admin()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
       

        $user_id = session()->get('user_id');

        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }


        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('user_id'));

         $background = session()->get('uploaded_bg') ?? '/Pictures/admin-bg.jpg';
    $backgroundColor = '#343a40';

    return view('pages/admindashboard', [
        'user' => $user,
        'background' => $background,
        'backgroundColor' => $backgroundColor,
    ]);
    }

    
   public function userlist()
{
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->select('user.id, user.username, user.email, car.car_model');
    $builder->join('rentals', 'rentals.user_id = user.id', 'left');
    $builder->join('car', 'car.id = rentals.car_id', 'left');
    $builder->groupBy('user.id'); // optional: if user has multiple rentals, show one
    $query = $builder->get();

    $data['users'] = $query->getResultArray();

    return view('pages/userlist', $data);
}

    public function uploadBackground()
{
    $file = $this->request->getFile('background');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/backgrounds', $newName);

        // Option 1: Store in session (or database if preferred)
        session()->set('uploaded_bg', '/uploads/backgrounds/' . $newName);

        return redirect()->to('/admin')->with('success', 'Background uploaded successfully!');
    }

    return redirect()->to('/admin')->with('error', 'Failed to upload image.');
}

public function viewRentals()
{
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
        return redirect()->to('/login');
    }

    $rentalModel = new RentalModel();
    $db = \Config\Database::connect();

    $builder = $db->table('rentals');
    $builder->select('rentals.*, user.username, user.email, car.car_name, car.car_model');
    $builder->join('user', 'user.id = rentals.user_id');
    $builder->join('car', 'car.id = rentals.car_id');
    $query = $builder->get();

    $data['rentals'] = $query->getResult();

    return view('admin/view_rentals', $data);
}




    
}
