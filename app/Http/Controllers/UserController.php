<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\UploadManager;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Página publica de locutores (users)
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPublic()
    {
        $users = User::all();
        $supporters = \App\Supporter::where('status', 1)->get();

        return view('users')->with([
            "users" => $users,
            'supporters' => $supporters
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index')->with("users", $users);
    }

    /**
     * Cadastra no banco de dados o cliente.
     *
     * @param  \Illuminate\Http\Request  $request(name, email, password)
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Este campo é obrigatório!',
            'email' => 'O email deve ser válido!',
            'email.unique' => 'Este email já está sendo utilizado!',
            'password.min' => 'A senha deve ter no mínimo :min caracteres'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'is_master' => 'required'
        ], $messages);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return response()->json(
                $validator->errors()
            , 422);
        }

        $createdUser = User::create([
            'name' => ucfirst($request->input()['name']),
            'email' => $request->input()['email'],
            'password' => bcrypt($request->input()['password']),
            'is_master' => $request->input()['is_master']
        ]);

        return $createdUser;
        //return $request->all();
    }

    /**
     * Mostra o perfil do user logado
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = User::find(Auth::user()->id);

        return view('dashboard.user.profile')->with('user', $user);
    }


    /**
     * Atualiza um usuário (senha e email).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $request (name, email)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required|unique:users,'.$id->id,
            'name' => 'required'
        ]);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $updatedUser = $id->update([
            'name' => ucfirst($request->input()['name']),
            'email' => $request->input()['email'],
        ]);

        return response()->json([
            'status' => 'Atualizado com sucesso!'
        ], 200);
    }

    /**
     * Troca de senha do usuário
     *
     * @param  int  $id(id do usuário), $request(senha)
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $messages = [
            'required' => 'O campo :attribute é obrigatório!',
            'novasenha.min' => 'A nova senha deve ter no mínimo :min caracteres'
        ];

        $validator = Validator::make($request->all(), [
            'senhaatual' => 'required',
            'novasenha' => 'required|min:6',
            'confirmarsenha' => 'required'
        ], $messages);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        if(!Hash::check($request['senhaatual'], $request->user()->password)){
            return back()->withErrors('Senha atual errada');
        }

        if($request['novasenha'] != $request['confirmarsenha']){
            return back()->withErrors('Nova senha e confirmação não conferem');
        }

        $user = User::find($request->user()->id);
        $user->password = bcrypt($request['novasenha']);
        $user->update();

        $request->session()->flash('success', 'Senha atualizada com sucesso!');
        return back();
    }

    /**
     * Envia avatar do usuario
     *
     * @param  int  $data
     * @return \Illuminate\Http\Response
     */
    public function uploadAvatar(Request $request)
    {
        $user = User::find($request->user()->id);

        $messages = [
            'required' => 'Selecione uma foto a ser enviada!',
            'mimes' => 'Imagem não suportada! Envie uma imagem em uma das seguintes extensões: jpeg, bmp, png, jpg.'
        ];
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|mimes:jpeg,bmp,png,jpg'
        ], $messages);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $path = UploadManager:: storeAvatar($user, $request->file('avatar'));

        $user->avatar = $path;
        $user->update();

        $request->session()->flash('success', 'Avatar atualizado com sucesso');
        return back();
    }

    /**
     * Remove um usuário
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $id)
    {
        if($id->id == Auth::id()) {
            return response()->json([
                'status' => 'Não é possível deletar você mesmo!'
            ], 422);
        }
        $id->delete();

        return response()->json([
            'status' => 'Usuário deletado com sucesso!'
        ], 200);
    }

    /**
     * Da ou retira master
     * @param $value(true, false), $user
     *  @return \Illuminate\Http\Response
     */
    public function setMaster(Request $request, User $user) {
        $validator = Validator::make($request->all(), [
            'value' => 'required|boolean'
        ]);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        if($user->id == Auth::id()) {
            return response()->json([
                'status' => 'Não é possível retirar seu próprio master!'
            ], 422);
        }

        $user->is_master = $request->input('value');
        $user->save();
        return response()->json([
            "status" => 'Operação concluida com sucesso!'
        ], 200);
    }

    /**
     * Retorna informações da conta de todos os uruários
     *
     *  @return \Illuminate\Http\Response
     */
    public function getUsers() {
        $users = User::paginate(10);

        return response()->json([
        $users
        ], 200);
    }

    /**
     * Retorna informações completas sobre um único usuário como numero de posts e infos básicas...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserComplete(User $user) {
        $user->post_count = Post::where('user_id', $user->id)->where('allowed', 1)->count();

        //$user->is_master = ($user->is_master)? "Sim" : "Não";
        return response()->json([
            $user
        ], 200);
    }
}
