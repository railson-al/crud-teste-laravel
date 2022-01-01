<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
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
            return back()->withErrors(['error', 'CPF não cadastrado!']);
        }
        
    }

    public function result(Request $request) {
        
        $symptoms = $request->symptoms;

        $response['symptoms'] = $symptoms;
        $response['number'] = count($symptoms);
        
        $response['percent'] = ($response['number'] / 14) * 100;

        if ($response['percent'] >= 60) {
            $response['message'] = "POSSÍVEL INFECTADO";

        } elseif($response['percent'] >= 40) {
            $response['message'] = "POTENCIAL INFECTADO";

        }else {
            $response['message'] = "SINTOMAS INSUFICIENTES";

        }
        
        return view('lists.result', ['response' => $response]);
    }
}