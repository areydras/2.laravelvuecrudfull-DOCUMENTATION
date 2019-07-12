<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    public function searchUser(){
        if($query = \Request::get('user')){
            return User::where('name' , 'LIKE', "%$query%")->orWhere('email', 'LIKE', "%$query%")->paginate(10);
        }else{
            return User::latest()->paginate(10);
        }
    }

    public function updateProfile(Request $request){
        $user = User::findOrFail(Auth::user()->id);

        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|min:5|max:191|unique:users,email,'.Auth::user()->id,
            'skils' => 'required|min:5|max:191',
            'phone' => 'required|min:5|max:191',
            'experience' => 'required|min:5',
            'password' => 'sometimes|min:8',
        ]);

        $currentImage = $user->image; //menyimpan nama file dari db sebelumnya ke variable


        if ($request->image != $currentImage) { //jika nama file tidak sama dengan nama yg ada didatabase(file sebelummnya)
            $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];

            \Image::make($request->image)->save(public_path('image/profile/' . $name)); //membuat image dengan kode base64 Image::make(KodeBase64)->save(public_path(menyimpan gambar ke folder public/image/profile/$name(diatas))) 
            $request->merge(['image' => $name]); //memasukan nama image yg sudah diubah kedalam $request->image
            
            $userPhoto = public_path('image/profile/') . $currentImage; //mengecek apakah ada file di folder public/image/profile/dengan nama file dari db sebelumnya
            if (file_exists($userPhoto)) { //jika ada nama file yg sama/file sebelumnya
                @unlink($userPhoto); //hapus file teresbut dengan link($userPhoto)
            }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request->password)]);
        }
        $user->update($request->all());
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|min:5|max:191|unique:users',
            'skils' => 'required|min:5|max:191',
            'phone' => 'required|min:5|max:191',
            'experience' => 'required|min:5',
            'password' => 'required|min:8|confirmed',
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'skils' => $request->skils,
            'phone' => $request->phone,
            'experience' => $request->experience
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|min:5|max:191|unique:users,email,'.$user->id,
            'skils' => 'required|min:5|max:191',
            'phone' => 'required|min:5|max:191',
            'experience' => 'required|min:5',
            'password' => 'sometimes|min:8',
        ]);    

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
