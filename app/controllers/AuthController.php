<?php

class AuthController extends BaseController {

	/**
	 * Account sign in.
	 *
	 * @return View
	 */
	// protected $url = 'https://'.$_SERVER['SERVER_NAME'];
	// protected $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
	// $uri = urldecode($uri);
	// protected $uri = $_SERVER['REQUEST_URI'];

	public function getSignin()
	{
	

		return View::make('login');
	}

	/**
	 * Account sign in form processing.
	 *
	 * @return Redirect
	 */
	public function postSignin()
	{
		$input = Input::all();
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = urldecode($uri);
		$urx = $_SERVER['REQUEST_URI'];
		// Declare the rules for the form validation
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required|between:3,32',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			if(isset($input['status'])){//its from the popup
				// return Request::path();
				// return var_dump($uri);
				// return Redirect::to('auth/login')->withInput()->withErrors($validator);
				return Response::json(array('errors' => json_decode($validator->messages())));
			}
			else{
				// return var_dump($uri.' '.$urx);
				return Redirect::back()->withInput()->withErrors($validator);
			}
			
		}

		try
		{
			// Try to log the user in
			Sentry::authenticate(Input::only('email', 'password'), Input::get('remember-me', 0));

	
			//check for any pending posts and assign then to the signed in user
			// $redirect = All::completePosting();

			// Get the page we were before
			// $redirect = !empty($redirect) ? $redirect : Session::get('loginRedirect', 'messages/received');
			// $contractor = User::find('contractor', '=', '1');

			$id = Sentry::getUser()->id;

			// return $rows; die('here');

				$redirect = Session::get('loginRedirect', 'user/todos');
				
				Session::forget('loginRedirect');

				// Redirect to the users page
				if(isset($input['status'])){//its from the popup
					return Response::json(array(
						'success' => Lang::get('auth/message.login.success'),
						'redirect' => $redirect
							));
				}
				else{
					return Redirect::to($redirect)->with('success', 'You have successfully logged in!');
					// return Redirect::to('success');
				}
				// var_dump('user'); die();
									
			


		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.wrong_password'));
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
		}
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_banned'));
		}

		// Ooops.. something went wrong	
		if(isset($input['status'])){//its from the popup
			// return Redirect::to('auth/login')->withInput()->withErrors($this->messageBag);
			return Response::json(array('errors' => $this->messageBag));
		}
		else{
			return Redirect::back()->withInput()->withErrors($this->messageBag);
			// return var_dump($uri.' '.$urx);
		}
	}

	/**
	 * Account sign up.
	 *
	 * @return View
	 */
	public function getSignup()
	{ 
		echo "signup";
		// Is the user logged in?
		// if (Sentry::check())
		// {
		// 	return Redirect::route('home');
		// }
		// if (isset($_SERVER["HTTP_REFERER"]) && stripos($_SERVER["HTTP_REFERER"], 'auth/signup')){
		// 	return View::make('account.signup');
		// }
		// else if (isset($_SERVER["HTTP_REFERER"])){
		// 	// return var_dump($_SERVER["HTTP_REFERER"]);
		// 	// return View::make('account.signup-basic');
		// 	// return Response::view('account.signup-basic');
		// 	return Response::view('account.signup');
		// }
		return View::make('account.signup');
	}



	public function postSignup()
	{
		$input = Input::all();
		// unset($input['company']);
		// return var_dump($input);
		// Declare the rules for the form validation
		$rules = array(
			'first_name'       => 'required|min:1',
			'last_name'        => 'required',
			'email'            => 'required|email|unique:users',
			// 'email_confirm'    => 'required|email|same:email',
			'password'         => 'required|between:3,32',
			'password_confirm' => 'required|same:password',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make($input, $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			if(isset($input['status'])){//its from the popup
				// return Redirect::to('auth/signup')->withInput()->withErrors($validator);
				return Response::json(array('errors' => json_decode($validator->messages())));
			}
			else{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}

		try
		{
			// Register the user
			$user = Sentry::register(array(
				'first_name' => Input::get('first_name'),
				'last_name'  => Input::get('last_name'),
				'email'      => Input::get('email'),
				'password'   => Input::get('password'),
			));

			//create company record if name has been given.
			if(!empty($input['company'])):
				Company::create(array(
					'name'=>$input['company'], 
					'image'=>'0.jpg', 
					'banner'=>'banner'.rand(1, 4).'.png',
					'creator'=>$user->id
					));
			endif;

			// Data to be used on the email view
			$data = array(
				'user'          => $user,
				// 'activationUrl' => URL::route('activate', $user->getActivationCode()),
			);

			// Send the activation code through email
			Mail::send('emails.register-activate', $data, function($m) use ($user)
			{
				$m->to($user->email, $user->first_name . ' ' . $user->last_name);
				$m->subject('Welcome ' . $user->first_name);
			});

			// Redirect to the register page			
			if(isset($input['status'])){//its from the popup
				return Response::json(array('success' => Lang::get('auth/message.signup.success')));
				// return Redirect::back()->with('success', Lang::get('auth/message.signup.success'));
			}
			else{
				// return Redirect::back()->with('success', Lang::get('auth/message.signup.success'));
				return Redirect::to('login');
			}
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
		}

		// Ooops.. something went wrong		
		if(isset($input['status'])){//its from the popup
			// return Redirect::to('auth/signup')->with('success', Lang::get('auth/message.signup.success'));
			return Response::json(array('errors' => $this->messageBag));
		}
		else{
			return Redirect::to('auth/signup')->withInput()->withErrors($this->messageBag);
		}
	}


	/**
	 * Account sign up form processing.
	 *
	 * @return Redirect
	 */
	public function postFundiSignup()
	{

		
		$input = Input::all();
		// unset($input['company']);
		// return var_dump($input);
		// Declare the rules for the form validation
		$rules = array(
			'first_name'       => 'required|min:1',
			'last_name'        => 'required',
			'email'            => 'required|email|unique:users',
			'business_name'	   => 'required',
			'phone' 		   => 'required',
			'password'         => 'required|between:3,32',
			'password_confirm' => 'required|same:password',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make($input, $rules);


		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			if(isset($input['status'])){//its from the popup
				// return Redirect::to('auth/signup')->withInput()->withErrors($validator);
				return Response::json(array('errors' => json_decode($validator->messages())));
			}
			else{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}

		try
		{
			// Register the user
			$user = Sentry::register(array(
				'first_name' 	=> Input::get('first_name'),
				'last_name'  	=> Input::get('last_name'),
				'business_name' => Input::get('business_name'),
				'phone'  	 	=> Input::get('phone'),
				'email'      	=> Input::get('email'),
				'password'   	=> Input::get('password'),
				'permissions' => array(
					        'user' => 1,					        
    								),
			));

			//create company record if name has been given.
			// if(!empty($input['business_name'])):
			// 	Company::create(array(
			// 		'name'=>$input['business_name'], 
			// 		// 'image'=>'no_logo.png', 
			// 		// 'banner'=>'banner'.rand(1, 4).'.png',
			// 		'creator'=>$user->id
			// 		));
			// endif;

			// Data to be used on the email view
			$data = array(
				'user'          => $user,
				// 'activationUrl' => URL::route('activate', $user->getActivationCode()),
			);

			// Send the activation code through email
			Mail::send('emails.register-activate', $data, function($m) use ($user)
			{
				$m->to($user->email, $user->first_name . ' ' . $user->last_name);
				$m->subject('Welcome ' . $user->first_name);
			});

			// Redirect to the register page			
			if(isset($input['status'])){//its from the popup
				return Response::json(array('success' => Lang::get('auth/message.signup.success')));
				// return Redirect::back()->with('success', Lang::get('auth/message.signup.success'));
			}
			else{
				// return Redirect::back()->with('success', Lang::get('auth/message.signup.success'));
				return Redirect::to('login');
			}
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
		}

		// Ooops.. something went wrong		
		if(isset($input['status'])){//its from the popup
			// return Redirect::to('auth/signup')->with('success', Lang::get('auth/message.signup.success'));
			return Response::json(array('errors' => $this->messageBag));
		}
		else{
			return Redirect::to('auth/csignup')->withInput()->withErrors($this->messageBag);
		}
	}


	/**
	 * User account activation page.
	 *
	 * @param  string  $actvationCode
	 * @return
	 */
	public function getActivate($activationCode = null)
	{
		// Is the user logged in?
		if (Sentry::check())
		{
			return Redirect::route('account');
		}

		try
		{
			// Get the user we are trying to activate
			$user = Sentry::getUserProvider()->findByActivationCode($activationCode);

			// Try to activate this user account
			if ($user->attemptActivation($activationCode))
			{
				// Redirect to the login page
				return Redirect::route('signin')->with('success', Lang::get('auth/message.activate.success'));
			}

			// The activation failed.
			$error = Lang::get('auth/message.activate.error');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$error = Lang::get('auth/message.activate.error');
		}

		// Ooops.. something went wrong
		return Redirect::route('signin')->with('error', $error);
	}

	/**
	 * Forgot password page.
	 *
	 * @return View
	 */
	public function getForgotPassword()
	{
		// Show the page
		// $message = '';
		return View::make('account.forgot-password');
	}

	/**
	 * Forgot password form processing page.
	 *
	 * @return Redirect
	 */
	public function postForgotPassword()
	{
		// Declare the rules for the validator
		$rules = array(
			'email' => 'required|email',
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::route('forgot-password')->withInput()->withErrors($validator);
		}

		try
		{
			// Get the user password recovery code
			$user = Sentry::getUserProvider()->findByLogin(Input::get('email'));

			// Data to be used on the email view
			$data = array(
				'user'              => $user,
				'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
			);

			// Send the activation code through email
			Mail::send('emails.forgot-password', $data, function($m) use ($user)
			{
				$m->to($user->email, $user->first_name . ' ' . $user->last_name);
				$m->subject('Account Password Recovery');
			});
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Even though the email was not found, we will pretend
			// we have sent the password reset code through email,
			// this is a security measure against hackers.
		}

		//  Redirect to the forgot password
		$message = 'Check your Email Address for your Password Request.';
		// $message = Lang::get('auth/message.forgot-password.success');
		return Redirect::route('forgot-password')->with('success', $message);
	}

	/**
	 * Forgot Password Confirmation page.
	 *
	 * @param  string  $passwordResetCode
	 * @return View
	 */
	public function getForgotPasswordConfirm($passwordResetCode = null)
	{
		try
		{
			// Find the user using the password reset code
			$user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);
		}
		catch(Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Redirect to the forgot password page
			return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
		}

		// Show the page
		return View::make('account.forgot-password-confirm');
	}

	/**
	 * Forgot Password Confirmation form processing page.
	 *
	 * @param  string  $passwordResetCode
	 * @return Redirect
	 */
	public function postForgotPasswordConfirm($passwordResetCode = null)
	{
		// Declare the rules for the form validation
		$rules = array(
			'password'         => 'required',
			'password_confirm' => 'required|same:password'
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::route('forgot-password-confirm', $passwordResetCode)->withInput()->withErrors($validator);
		}

		try
		{
			// Find the user using the password reset code
			$user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);

			// Attempt to reset the user password
			if ($user->attemptResetPassword($passwordResetCode, Input::get('password')))
			{
				// Password successfully reseted
				return Redirect::route('login')->with('success', Lang::get('auth/message.forgot-password-confirm.success'));
			}
			else
			{
				// Ooops.. something went wrong
				return Redirect::route('login')->with('error', Lang::get('auth/message.forgot-password-confirm.error'));
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Redirect to the forgot password page
			return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
		}
	}

	/**
	 * Logout page.
	 *
	 * @return Redirect
	 */
	public function getLogout()
	{
		Session::flush();
		// Log the user out
		Sentry::logout();


		// Redirect to the users page
		return Redirect::route('home')->with('success', 'You have successfully logged out!');
	}

}
