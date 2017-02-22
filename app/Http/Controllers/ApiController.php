<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $result = array();

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'  => 'required|min:4|unique:register',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:register',
            'password' => 'required|confirmed|min:6',
            'role' => 'required',
        ]);
    }


    public function index(Request $request)
    {
        //
        $token = str_random(40);
        //print_r($request->input());
         $validator = $this->validator($request->all());
        if ($validator->fails()) {

            $errors = $validator->errors();

            //print_r($errors->all());
            $this->result['status'] = '0';
            $this->result['status_code'] = '201';
            $this->result['error'] = $errors;

        } else {

            $registerArr = $request->all();
            unset($registerArr['password_confirmation']);
            $registerArr['active'] = 'N';
            $registerArr['api_token'] = $token;
            //print_r($registerArr);

            DB::table('register')->insert($registerArr);

            $this->result['status'] = '1';
            $this->result['status_code'] = '200';
            $this->result['token'] = $token;

        } //endif

         //print_r($validator);

		 return response()->json($this->result);
        }

    /**
     print_r(* Show the form for creating a new resource).
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
