<?php
  namespace App\Http\Controllers;

  use Illuminate\Http\Request;

  use Illuminate\Http\Response;

  use Illuminate\Support\Facades\Auth;

  use Illuminate\Support\Facades\File;

  use Illuminate\Support\Facades\Storage;


  use App\User;

  class UserController extends Controller {

    public function postSignUp(Request $request) {

      $this->validate($request, [

        'email' => 'required|email|unique:users',
        'first_name' => 'required|max:120',
        'password' => 'required|min:6'

      ]);

      $email = $request['email'];

      $first_name = $request['first_name'];

      $password = bcrypt($request['password']);

      $user = new User();

      $user->email = $email;
      $user->first_name = $first_name;
      $user->password = $password;

      //Write to DB

      $user->save();

      return redirect()->route('dashboard');

    }

    public function postSignIn(Request $request) {

      $this->validate($request, [

        'email' => 'required|email',
        'password' => 'required'

      ]);

      if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {

        return redirect()->route('dashboard');

      } else {

        return redirect()->back();
      }

    }

    public function getLogout() {
      Auth::logout();
      return redirect()->route('home');
    }

    public function getAccount() {
      if (Auth::user()) {
        return view('vendor/account', ['user' => Auth::user()]);
      }
      return redirect()->route('dashboard');
    }

    public function postSaveAccount(Request $request) {
      $this->validate($request, [

        'first_name' => 'required|max:120'

      ]);

      $user = Auth::user();
      $imagePath = Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg') ? $user->first_name . '-' . $user->id . '.jpg' : '';
      $user->first_name = $request['first_name'];
      $user->update();
      $file = $request->file('image');
      $fileName = $request['first_name'] . '-' . $user->id  . '.jpg';
      if ($file) {
        Storage::disk('local')->put($fileName, File::get($file));
      } elseif ($imagePath) {
        File::move(storage_path('app/'.$imagePath),storage_path('app/'.$fileName));
      }

      return redirect()->route('account');

    }

    public function getUserImage($fileName) {
      $file = Storage::disk('local')->get($fileName);
      return new Response($file, 200);
    }

  }

 ?>
