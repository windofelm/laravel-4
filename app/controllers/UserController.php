<?php

class UserController extends BaseController{

	// Kullanıcı oluşturma metodu
	public function getCreate()
	{

		return View::make('user.register');
	}

	// Login metodu
	public function getLogin()
	{

		return View::make('user.login');
	}


	public function postCreate(){

		$vaildate = Validator::make(Input::all(),array(

			'username' => 'required|unique:users|min:4',
			'pass1' => 'required|min:6',
			'pass2' => 'required|same:pass1'

		));

		if($vaildate->fails()){

			return Redirect::route('getCreate')->withErrors($vaildate)->withInput();
		}else{


			$user = new User();
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('pass1'));

			if($user->save()){

				return Redirect::route('home')->with('success', 'You registered successfully. You can now log in.');
			}else{

				return Redirect::route('home')->with('fail', 'An error occured when creating the user. Please try again.')->withInput();
			}
		}
	}


	public function postLogin(){

		$validator = Validator::make(Input::all(), array(

			'username' => 'required',
			'pass1' => 'required'
		));

		if($validator->fails()){

			return Redirect::route('getLogin')->withErrors($validator)->withInput();
		}else{

			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(

				'username' => Input::get('username'),
				'password' => Input::get('pass1')
			), $remember);

			if($auth){

				return Redirect::intended('/');
			}else{

				// withInput değeri blade tarafında postback olduğunda {{ Input::old('username') }} kullanarak eski değerlerin 'pass1' dışında doldurulması içindir.
				return Redirect::route('getLogin')->with('fail','You entred the wrong login credentials, please try again.')->withInput(Input::except('pass1'));
			}


		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home');
	}
}