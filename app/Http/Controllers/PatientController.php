<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Exception;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::get();
        return view('lists.patients', ['patients' => $patients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('forms.patients');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->ajax()) {  

            $cpf = $request->cpf;

            $patientExists = Patient::where('cpf', '=', $cpf)->first();
            
            if($patientExists) {
                $response['status'] = false;
                $response['message'] = "o CPF informado já está cadastrado";

                echo json_encode($response);
                return;
            }

            if ($request->hasFile('file_path') && $request->file('file_path')->isValid()) {
            
                $image = $request->file_path;
                $extension = $image->extension();
    
                $hashImagePath = md5($image->getClientOriginalName() . strtotime('now') . '.' . $extension);
    
                $image->move(public_path('img/events', $hashImagePath));
    
                $data = [
                    'name'      => mb_strtoupper($request->name),
                    'age'       => $request->age,
                    'cpf'       => $request->cpf,
                    'phone'    => $request->phone,
                    'file_path'=> $hashImagePath
                ];

                Patient::create($data);

                $response['status'] = true;
                $response['message'] = "Paciente cadastrado!";

                echo json_encode($response);
                return;
    
                
    
            } else {
                $response['status'] = false;
                $response['message'] = "Insira uma imagem válida!";

                echo json_encode($response);
                return;
            }
        }

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
        try{

            $selectedPatient = Patient::findOrFail($id);
            return response()->json($selectedPatient);

        }catch(Exception $err) {
            return response()->json($err);
        }
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

        dd($request->all());
        $patient = Patient::findOrFail($id);

        try {

            $data = $patient->update($request->all());
            $response['status'] = true;
            $response['message'] = 'Usuário alterado com sucesso';
            // echo json_encode($response);
            // return Redirect::route('patients');
            return response()->json($response);


        } catch (Exception $err) {
            $response['status'] = false;
            $response['message'] = 'Não foi possível concluir as alterações';
            $response['error'] = $err->getMessage();
            // echo json_encode($response);
            // return Redirect::route('patients');
            return response()->json($response);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $patient = Patient::findOrFail($request->id);

        try {
            $data = $patient->delete($request->id);
            $response['status'] = true;
            $response['message'] = 'Usuário removido com sucesso';
            echo json_encode($response);
            return;

        } catch (Exception $err) {
            $response['status'] = false;
            $response['message'] = 'Não foi possível concluir as alterações';
            $response['error'] = $err->getMessage();
            echo json_encode($response);
            return;

        }
    }
}
