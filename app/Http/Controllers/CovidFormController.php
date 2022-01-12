<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\CovidForm;
use Exception;

class CovidFormController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.symptoms');
    }

    public function findUser(Request $request) {

        try{ 

            $patient = Patient::where('cpf', $request->cpf)->first();
            
        } catch (Exception $e) {

            return;

        }
        if(isset($patient)) {

            return view('forms.form', ['patient' => $patient]);

        } else {
            return back()->withErrors(['CPF não cadastrado!']);
        }
        
    }

    public function result(Request $request) {
        
        $cpf = $request->cpf;
        $cpf = trim($cpf);
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("-", "", $cpf);
        $cpf = str_replace(" ", "", $cpf);
        $cpf = str_replace("-", "", $cpf);
        $symptoms = $request->symptoms;

        if(!isset($symptoms)) { //check if symptoms has empty

            return back()->withErrors(['Selecione ao menos um sintoma!']);

        }

        //make response data
        $response['symptoms'] = $symptoms;
        $response['number'] = count($symptoms);
        $response['percent'] = number_format(($response['number'] / 14) * 100, 2, ',');
        
        //Calculate symptoms percentage result
        if ($response['percent'] >= 60) {
            $response['result'] = "POSSÍVEL INFECTADO";

        } elseif($response['percent'] >= 40) {
            $response['result'] = "POTENCIAL INFECTADO";

        }else {
            $response['result'] = "SINTOMAS INSUFICIENTES";

        }

        try {
            
            $patient = Patient::where('cpf', $cpf)->first();            
          
        } catch (Exception $err) {

            return view('lists.result', ['response' => $response]);
        }

        $response['patient_id'] = $patient->id;
        $response['user_id'] = $request->user_id;

        //create data in database
        CovidForm::create($response);
        
        return view('lists.result', ['response' => $response]);
    }
}