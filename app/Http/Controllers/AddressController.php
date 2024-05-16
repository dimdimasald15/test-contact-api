<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create(Request $request)
    {
        $id_contact = $request->id;
        $data = [
            'title' => "Address",
            "nav" => "contacts",
            "contact_id" => $id_contact
        ];

        return view('admin.addresses.create', $data);
    }
    public function edit($id_contact, $id, Request $request)
    {
        $url = $this->urlApi . "contacts/$id_contact/addresses/$id";
        $token = $request->token;
        $fetchdata = $this->getUrl($url, $token);
        $address = json_decode($fetchdata, true);
        $data = [
            'title' => "Address",
            "nav" => "contacts",
            "contact_id" => $id_contact,
            "address_id" => $id,
            'street' => $address['data']['street'],
            'city' => $address['data']['city'],
            'postal_code' => $address['data']['postal_code'],
            'country' => $address['data']['country'],
            'province' => $address['data']['province'],
        ];

        return view('admin.addresses.update', $data);
    }
}
