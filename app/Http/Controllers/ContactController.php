<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Contacts',
            'nav' => 'contacts'
        ];
        return view('admin.contacts.index', $data);
    }

    public function modaladdshow()
    {
        $data = [
            'title' => "Form Add Contact",
        ];
        $msg = [
            'success' => View::make('admin.contacts.modal.create', $data)->render()
        ];

        echo json_encode($msg);
    }
    public function modalupdateshow($id, Request $request)
    {
        $url = $this->urlApi . 'contacts/' . $id;
        $token = $request->header('Authorization');
        $fetchdata = $this->getUrl($url, $token);
        $contact = json_decode($fetchdata, true);

        $data = [
            'title' => "Form Update Contact",
            'id' => $contact['data']['id'],
            'firstname' => $contact['data']['firstname'],
            'lastname' => $contact['data']['lastname'],
            'email' => $contact['data']['email'],
            'phone' => $contact['data']['phone'],
        ];

        $msg = [
            'success' => View::make('admin.contacts.modal.update', $data)->render()
        ];

        echo json_encode($msg);
    }
    public function modaldetailshow($id, Request $request)
    {
        $url = $this->urlApi . 'contacts/' . $id;
        $token = $request->header('Authorization');
        $fetchdata = $this->getUrl($url, $token);
        $contact = json_decode($fetchdata, true);

        $data = [
            'title' => "Detail Contact",
            'id' => $contact['data']['id'],
            'firstname' => $contact['data']['firstname'],
            'lastname' => $contact['data']['lastname'],
            'email' => $contact['data']['email'],
            'phone' => $contact['data']['phone'],
        ];

        $msg = [
            'success' => View::make('admin.contacts.modal.detail', $data)->render()
        ];

        echo json_encode($msg);
    }
}