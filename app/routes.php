<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function()
{
	return View::make('hello');
});*/
/*

1. Các Router cơ bản
Các router trong Laravel được định nghĩa trong file app/routes.php, router đơn giản nhất trong Laravel bao gồm một chỉ định URI và một hàm callback, ví dụ sau giúp các bạn dễ hình dung hơn:
- Get Router
Route::get('/', function()
{
    return 'Hello World';
});
 
- Post Router
Route::post('product/add', function()
{
    return 'Add new Product';
});
 
- Nhiều loại Request khác nhau
Route::any('product', function()
{
    return 'Any Request';
});
 
- Request phải thông qua https
Route::get('product', array('https', function()
{
    return 'HTTPS Request';
}));

*/

/*
==========================================================
2. Các router có Parameters
 
- Giả sử các bạn muốn truyền vào một id trên URL, chúng ta sẽ làm như sau:
Route::get('product/{id}', function($id)
{
    return 'Product ' . $id;
});
 
- Nếu chúng ta muốn là id chúng ta truyền vào có thể không cần thì chúng ta dùng như sau:
Route::get('product/{alias?}', function($alias = null)
{
    return $alias;
});
 
- Giả sử chúng ta muốn truyền id vào, và nếu không có thì chúng ta sẽ set nó mặc định là một giá trị nào đó, chúng ta gọi như sau:
Route::get('product/{id?}', function($id = 0)
{
    return $id;
});
 
- Bây giờ chúng ta sẽ đến với các router có sử dụng Regular Expression, đây là một nhu cầu dường như có trong tất cả các PHP framework mà tôi đã từng sử dụng qua. Ví dụ, các bạn muốn id của chúng ta truyền trên url xuống chỉ có chứa số từ 0-9:
Route::get('product/{id}', function($id)
{
    return $id;
})
->where('id', '[0-9]+');
Riêng phần này, các bạn phải hiểu về Regular Expression thì mới có thể sử dụng được, tuy nhiên đối với các request thông thường thì chúng ta chỉ cần biết sơ qua một vài Pattern là đủ rồi, ví dụ một alias chỉ chứa các chữ cái thường, chữ số và dấu gạch ngang, chúng ta chỉ cần:
Route::get('product/{alias}', function($alias)
{
    return $alias;
})
->where('alias', '[a-z][a-z0-9-][a-z]+');
Chúng ta cũng có thể pass nhiều params cùng một lúc, chúng ta làm như sau:
Route::get('product/{id}/{alias}', function($id, $alias)
{
    return $id . ' ' . $alias;
})
->where(array('id' => '[0-9]+', 'alias' => '[a-z]+'))
*/

/*
==========================================================
3. Các router đi kèm các filter
 
Laravel Framework cung cấp cho chúng ta một cách để giới hạn truy cập vào một thành phần nào đó trong ứng dụng của chúng ta 
thông qua Filter, tại đây các bạn có thể định nghĩa ra những filter để có thể áp vào một request nào đó, ví dụ như đi vào trang quản trị admin chẳng hạn.
Các filter được định nghĩa trong file app\filters.php, mở file này lên chúng ta sẽ thấy một số dòng sau:
App::before(function($request)
	{
	  //
	});
	  
	App::after(function($request, $response)
	{
	  //
	});
Phương thức before chỉ định cho Laravel phải làm gì đó trước khi request vào đâu đó, và phương thức after chỉ định làm cái gì
đó sau khi request xong và trước khi trả kết quả về cho người dùng.
 
Chúng ta sẽ xem xét thêm một số dòng có trong file này, ví dụ:
	Route::filter('auth', function()
	{
		if (Auth::guest()) return Redirect::guest('login');
	});
Ở đây, chúng ta có thể thấy phương thức filter chính là phương thức để chúng ta định nghĩa ra filter, nó có 2 tham số truyền vào, 
một đó là tên của filter, 2 đó chính là một Closure, đây là một khái niệm khá mới trong PHP có từ PHP 5.3.
Trong hàm này Laravel kiểm tra xem người dùng có phải là guest hay không, nếu phải thì redirect đến trang login.
Phần này liên quan đến authentication, chúng ta sẽ tìm hiểu kỹ hơn trong một bài viết khác, bây giờ chúng ta sẽ làm một ví dụ nhỏ 
với cái filter này, chúng ta sẽ check xem id của product truyền vào có lớn hơn 0 hay không, đầu tiên chúng ta sẽ cần định nghĩa một filter như sau:
	Route::filter('check_id', function($route)
	{
		$id = Request::segment(2);
		if($id < 1){
			return 'Không hợp lệ!';
		}
	});
 
Sau đó chúng ta sẽ set một router cùng với cái filter này:
	Route::get('product/{id}',array('before' => 'check_id', function()
	{
		return 'Hợp lệ';
	}));
Bây giờ chúng ta sẽ truy cập vào:
	http://localhost/laravel/helloword/product/-10
Trình duyệt sẽ in ra chữ "Không hợp lệ!", ngược lại nếu chúng ta truy cập:
	http://localhost/laravel/helloword/product/1
Trình duyệt sẽ báo hợp lệ.
 
Chúng ta cũng có thể sử dụng nhiều filter cho một router, chúng ta làm như sau:
	Route::get('product/{id}', array('before' => 'auth|check_id', function()
	{
		return 'Bạn là admin và được phép xem sản phẩm!';
	}));
Hay chúng ta có thể truyền vào như là một array:
	Route::get('product/{id}', array('before' => array('auth', 'check_id'), function()
	{
		//
	}));
 
Chúng ta cũng có thể chỉ định một filter bằng pattern, giả sử khi chúng ta truy cập vào admin và các thành phần trong admin,
chúng ta cần ngăn cản người dùng, chỉ có admin mới vào được các phần này, chúng ta sẽ thêm như sau:
	Route::filter('admin', function()
	{
		//
	});
	Route::when('admin/*', 'admin');
 
Chúng ta cũng có thể sử dụng class cho việc filter này, ví dụ như sau:
	Route::filter('product', 'ProductFilter');
Và chúng ta tạo thêm một class ProductFilter để filter như sau:
	class ProductFilter {
	 
		public function filter()
		{
			// Filter logic...
		}
	 
	}
Mặc định thì phương thức filter là filter(), các bạn cũng có thể chỉ định một phương thức để filter:
	Route::filter('product', 'ProductFilter@check');
======================================================
4. Đặt tên cho các router
 
Chúng ta có thể đặt tên cho các router của chúng ta, cái này để chúng ta có thể sử dụng lại khi chúng ta redirect đến router, để đặt tên cho router chúng ta làm như sau:
	Route::get('product/add', array('as' => 'add', function()
	{
		//
	}));
Hay chỉ định router đến controller:
	Route::get('product/add', array('as' => 'add', 'uses' => 'ProductController@add'));
Sau đó giả sử chúng ta muốn redirect thì chúng ta chỉ cần sử dụng:

	$url = URL::route('add');
	$redirect = Redirect::route('add');

======================================================
5. Nhóm các router
Chúng ta có thể nhóm các router lại với nhau thông qua phương thức group của router:
	Route::group(array('before' => 'auth'), function()
	{
		Route::get('/', function()
		{
			//
		});
	 
		Route::get('user/profile', function()
		{
			//
		});
	});
*/

Route::get('/', 'HomeController@showWelcome');
Route::get('/login', 'HomeController@login');
Route::post('/login', 'HomeController@checkLogin');
 

Route::get('dang-nhap', function(){
    echo 'Day trang dang nhap';
});

// Example route: filter before
Route::get('testId/{id}',array('before'=> 'check_id', function(){
	return 'Valid';
}));

Route::get('/hello','HomeController@helloworld');
Route::get('/hellonest','HomeController@helloNest');
Route::get('/hellolayout','HomeController@helloLayout');


Route::group(array('prefix' => 'admin', 'before' => ['auth', 'admin']), function() {
    Route::get('/', 'admin\HomeController@showWelcome');
});

Route::filter('admin', function()
{
    $user = User::find(Auth::user()->id);
    if($user->role->alias !== 'admin'){
        return Redirect::to('login');
    }
});
