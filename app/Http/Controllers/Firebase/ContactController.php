<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class ContactController extends Controller
{
    //
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'contacts';
    }
    public function index()
    {
        $contacts = $this->database->getReference($this->tablename)->getValue();
        $totalcontacts = $this->database->getReference($this->tablename)->getSnapshot()->numChildren();
        return view('firebase.contact.index', compact('contacts','totalcontacts'));
    }
    public function create()
    {
        return view('firebase.contact.create');
    }
    public function store(Request $request)
    {
        $postData = [
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'contact' => $request->contact_number,
            'email' => $request->email
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);
        if ($postRef) {
            return redirect('contacts')->with('status', 'Contact Added successfully');
        } else {
            return redirect('contacts')->with('status', 'Contact not added');
        }
    }
    public function edit($id)
    {
        $key = $id;
        $updated_contacts = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if ($updated_contacts) {
            return view('firebase.contact.edit', compact('updated_contacts', 'key'));
        } else {
            return redirect('contacts')->with('status', 'Contact ID not found');
        }
    }
    public function update(Request $request, $id)
    {
        $key = $id;
        $updateData = [
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'contact' => $request->contact_number,
            'email' => $request->email,
        ];
        $updated = $this->database->getReference($this->tablename . '/'. $key)->update($updateData);
        if ($updated) {
            return redirect('contacts')->with('status', 'Contact updated successfully');
        } else {
            return redirect('contacts')->with('status', 'Contact not updated');
        }
    }
    public function delete($id){
        $key = $id;
        $deleted = $this->database->getReference($this->tablename . '/'. $key)->remove();
        if ($deleted) {
            return redirect('contacts')->with('status', 'Contact deleted successfully');
        } else {
            return redirect('contacts')->with('status', 'Contact not deleted');
        }

    }
}
