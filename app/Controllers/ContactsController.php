<?php

namespace App\Controllers;

use App\Models\ContactsModel;

class ContactsController extends BaseController
{
    protected $contacts;

    function __construct()
    {
        $this->contacts = new ContactsModel();
    }

    public function index()
    {
        $data['contacts'] = $this->contacts->findAll();

        return view('contacts/index', $data);
    }

    public function create()
    {
        $this->contacts->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect('contacts')->with('success', 'Data Added Successfully');
    }

    public function edit($id)
    {

        $this->contacts->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect('contacts')->with('success', 'Data Updated Successfully');
    }
    public function delete($id)
    {
        $this->contacts->delete($id);

        return redirect('contacts')->with('success', 'Data Deleted Successfully');
    }
}
