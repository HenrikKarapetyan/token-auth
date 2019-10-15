# Hash Auth!

How to install

    composer require henrik/token-auth


####	Configurations  For Laravel Framework.


- Create a helper file  `app\Helpers\TokenManagerHelper.php`.

```php
<?php
namespace App\Helpers;
use HashAuth\TokenManager;

/**
 * Class TokenManagerHelper * @package App\Helpers
 */
 class TokenManagerHelper {
	  /**
	 * @return TokenManager
	 * @throws \Exception
	 */
	 public static function getManagerInstance()
	 {
		 return new TokenManager(
		  config('hash_auth.token_private_key'),
		  config('hash_auth.token_private_iv'),
		  config('hash_auth.signature_private_key')
		 );
	 }
 }
```

- Then  create  `hash_auth.config` file into your laravel  configs folder.
```php
<?php

return [
  'token_private_key' => env('TOKEN_PRIVATE_KEY', ''),
  'token_private_iv' => env('TOKEN_PRIVATE_IV', ''),
  'signature_private_key' => env('SIGNATURE_PRIVATE_KEY', '')
];
```
- Then add into  your `.env` file this  lines

```
SIGNATURE_PRIVATE_KEY="secret_line1"
TOKEN_PRIVATE_IV="secret_line2"
TOKEN_PRIVATE_KEY="secret_line3"
```
- Type in  your console

    php artisan  make:middleware HashAuthFilterMiddleware

 - Then paste  this code into created file
```php
<?php

	namespace App\Http\Middleware;
	use App\Helpers\TokenManagerHelper;
	use Carbon\Carbon;
	use Closure;
	use HashAuth\Exceptions\HashAuthException;
	use Illuminate\Http\Request;
	use Illuminate\Http\Response;


    class HashAuthFilterMiddleware{
     /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
     public function handle(Request $request, Closure $next)  {
	     try {
			 $unparsed_token = $request->header("Authorization");
			 if (empty($unparsed_token)) {
			       $unparsed_token = $request->input('token');
		     } else {
			       $unparsed_token = str_replace('Bearer ', '', $unparsed_token);
		     }
		     $tokenManager = TokenManagerHelper::getManagerInstance();
		     $parsed_token = $tokenManager->parseToke($unparsed_token, [
			      'exp' => Carbon::now()->timestamp,
			      'sessId' => 0,
			      'browserId' => $request->header('User-Agent')
		      ]);
		      // $parsed_token  it's a  data which  is  saved into token
	      } catch (HashAuthException $e) {
		      return response(
		      [
			      'message' => 'You dont has access for this action'
		      ],
		      Response::HTTP_FORBIDDEN
		      );
	     }
	     return $next($request);
	 }
   }
  ```
open Kernel.php file and add middleware into $routeMiddleware  like this

```php
protected $routeMiddleware = [
	'auth' => \App\Http\Middleware\Authenticate::class,
	// ...
	'hash.auth' => \App\Http\Middleware\HashAuthFilterMiddleware::class,
	// ...
];
```
- Add this functions into your `User.php` model
```php
	 /**
	 * @param $request
	 * @return mixed
	 * @throws \Exception
	 */
	 public function createNewAccessToken($request, $user)
	 {
		  $tokenManager = TokenManagerHelper::getManagerInstance();
		  $claims = $this->getClaims($request);
		  $token = $tokenManager->makeToken($user, $claims);
		  return $token;
	 }
	 private function getClaims(Request $request)
	 {
		 $claims = [
			 'exp' => Carbon::now()->timestamp + (2 * 60 * 60),
			 'browserId' => $request->header('User-Agent'),
		 ];
		 return $claims;
	 }
```


The example login  action (must return token string in json format):

```php
 public function Login(User $user, Request $resuest){
	$token = $user->createNewAccessToken($request, $user);
	// ...
}
```



The registered  middleware you  can  use for  your routes.
For example:
```php
	Route::group(['middleware' => ['hash.auth']], function () {
		// your routes here
	}
	Route::get('your-route', 'Controller@Action')->middleware('hash.auth');
```

The request lifecycle in graph dagram.
```mermaid
graph LR
R[Request With Token] --> HAM
HAM --> R
HAM((HashAuthFilterMiddleware)) -->A
A-->HAM

A[Token Manager] -- Token --> TP((Token Parser))
TP -- data --> A
TB((Token Builder)) -- token --> A
A -- data --> TB
TB --> T{Token}
TP --> T
CL[Claim] --> T
DL[DataLine] -->T


