<?php

namespace App\Controllers;

use App\Models\ProfileModel;

class ProfileController extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $data = [];
        return view('profile/index', $data);
    }

    public function edit()
    {
        // Receive form data
        $postData = $this->request->getPost();

        // Validate incoming data if needed

        // Update user's record in the database
        $userId = user()->id;
        $data = [
            'name' => $postData['principal_name'],
            'email' => $postData['principal_email'],
            'company_name' => $postData['principal_company'],
            'phone' => $postData['phone']
        ];
        $this->profileModel->update($userId, $data);

        // Optionally, you can set flash data to show a success message
        session()->setFlashData('success', 'Profile updated successfully');

        // Redirect to the index page or any other page
        return redirect()->to('profile');
    }
}
