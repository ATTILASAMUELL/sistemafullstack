<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


use App\Models\User;

class ApiController extends Controller
{
    //
    public function createUsuario(Request $request)
    {
        $array = ['error'=>''];

  

        $rules =[
            'nome' => 'required|min:5',
            'email' => 'required|min:5',
            'cpf' => 'required|min:5',
            'endereco' => 'required|min:5',
            'cep' => 'required|min:5',
            'numero' => 'required|min:1',
            'bairro' => 'required|min:5',
            'pais' => 'required|min:5',
            'cidade'=> 'required|min:5',
            'estado'=> 'required|min:5'

        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json([
                'error' => true,
                'dados' => $request->all()
            ],401);
        }

        $nome = $request->input('nome');
        $email = $request->input('email');
       
        $endereco = $request->input('endereco');
        $cep = $request->input('cep');
        $numero = $request->input('numero');
        $bairro = $request->input('bairro');
        $pais = $request->input('pais');
        $cpf = $request->input('cpf');
        $cidade = $request->input('cidade');
        $estado =  $request->input('estado');


        $usuario = New User;
        $usuario->name = $nome;
        $usuario->email = $email;
        $usuario->status = 0;
        $usuario->cpf = $cpf;
        $usuario->password =Hash::make('1234');


        $usuario ->save();

        $usuario->enderecos()->create([
            'logradouro' => $endereco,
            'numero' => $numero,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'estado' => $estado,
            'pais' => $pais,
            'cep' => $cep

        ]);


        return response()->json([
            'error' => false

        ],200);

    }
    public function listarUsuarios(Request $request)
    {
        $usuarios = User::with('enderecos')->get();

        return response()->json([
            'dados' => $usuarios

        ],200);
        
    }

    public function listarUsuario(Request $request)
    {
        
    }

    public function editarUsuario(Request $request)
    {
    
        $rules =[
            'nome' => 'required|min:5',
            'email' => 'required|min:5',
            'cpf' => 'required|min:5',
            

        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json([
                'error' => true,
                'dados' => $request->all()
            ],401);
        }

        $nome = $request->input('nome');
        $email = $request->input('email');
       
        $cpf = $request->input('cpf');
        
    


        $usuario = User::where('email',$email)->first();
        
        $usuario->name = $nome;
        $usuario->email = $email;
        $usuario->cpf = $cpf;

        $usuario->save();

       

        return response()->json([
            'error' => false

        ],200);
        
    }
    public function editarStatus($email,Request $request)
    {
       
     
        
        if($request->input('codigo'))
        {
            $codigo = '123456789';
            if($request->input('codigo') == $codigo)
            {
                $usuario = User::where('email',$email)->first();
                
                if($usuario)
                {
                    if($usuario->status == 0)
                    {
                        $usuario->status = 1;

                    }else{
                        $usuario->status = 0;


                    }
                    $usuario->save();
                }
            }

        }

        
    }
    public function deletarUsuario($email)
    {

        $usuario = $email;
       
        if($usuario)
        {
            $user = User::where('email',$usuario)->first();
            if($user)
            {
               
                $user->enderecos()->delete();
                $user->delete();
            }
        }
        
    }

    
}
