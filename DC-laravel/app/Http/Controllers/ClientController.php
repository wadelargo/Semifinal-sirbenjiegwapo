<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {

        $client = Client::orderBy('id')
                ->orderBy('last_name')->get();

        return response()->json($client);
    }

    public function view(Client $client) {

        return response()-> json([
            'status' => 'OK',
            'data' => $client,
        ]);
    }

        public function store(Request $request) {
            $fields = $request->validate([
                'last_name' => 'required| string',
                'first_name' => 'required| string',
                'address' => 'required| string',
                'phone' => 'required| string',
                'email' => 'required| string',
                'sex' => 'required| string',
                'birth_date' => 'required| date',
                'max_credit' => 'required| numeric|between:0,9999999999,99',
            ]);
            $client =Client::create($fields);

            return response()->json ([
                'status' => 'OK',
                'message' => 'A new Student is added with an id#' . $client->id
            ]);
        }
        public function destroy(Client $client) {
            $details = $client->last_name . ", " . $client->first_name;
            $client->delete();

            return response()->json([
                'status'=> 'OK',
                'message' =>'The student = Name:' . $details . 'has been deleted.'
            ]);
        }

        public function update(Request $request, Client $client) {
            $fields = $request->validate([
                'last_name' => 'string',
                'first_name' => 'string',
                'address' => 'string',
                'phone' => 'string',
                'email' => 'string',
                'sex' => 'string',
                'birth_date' => 'date',
                'max_credit' => 'numeric'
            ]);

            $client->update($fields);

            return response()->json([
                'status' => 'OK',
                'message' => 'Student with ID# ' . $client->id . 'has been updated'
            ]);
        }

}
