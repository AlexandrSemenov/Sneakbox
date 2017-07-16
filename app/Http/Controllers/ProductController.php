<?php

namespace App\Http\Controllers;

use Mail;
use Auth;
use App\Components\ProductRepository;
use App\Components\UploadImage;
use App\Components\Slug;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductCreateForm;
use Illuminate\Http\Request;
use App\Components\QueryParams;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Components\CleanProductsService;


class ProductController extends Controller
{
    public function index(ProductRepository $productRepository)
    {
        if(!empty($_GET))
        {
            $filterProduct = new Product();
            $products = $filterProduct->productFilter();
        }else{
            /**
             * если get массив пустой
             */
            $products = Product::where('active','=',1)->orderBy('updated_at', 'desc')->paginate(16);
        }
        $queryParams = new QueryParams();
        $form = new ProductCreateForm();
        $range = $productRepository->getPriceRange();

        return view('product.index', ['products'=>$products, 'form'=>$form, 'queryParams' => $queryParams, 'range' => $range]);
    }

    public function createProduct()
    {
        $form = new ProductCreateForm();

        return view("product.create", ['form'=>$form]);
    }

    public function saveProduct(Request $request, UploadImage $uploadimage, Slug $slug)
    {
        $rules = [
            'title' => 'required|regex:/^[(a-zA-Za-zА-Яа-яЁёґєії`´ʼ’ʼ"&-.\'’Z0-9\s)]+$/u',
            'price' => 'required|integer',
            'description' => 'required',
            'image' => 'mimes:jpeg,png|max:1500',
        ];
        $messages = [
            'title.required' => 'Необходимо заполнить заголовок',
            'title.regex' => 'Заголовок может содержать только буквы и цифры',
            'price.required' => 'Необходимо указать цену',
            'price.integer' => 'Поле цена должно иметь корректное целочисленное значение',
            'description.required' => 'Добавьте описание для товара',
            'image.mimes' => 'Тип изображение должен быть jpeg или png',
            'image.max' => 'Изображение не может быть больше 1.5 мегабайт',
            'gallery.mimes' => 'Тип изображение должен быть jpeg или png',
            'gallery.max' => 'Изображение не может быть больше 1.5 мегабайт.'
        ];

        $count = count($request['gallery'])-1;
        foreach(range(0, $count) as $index)
        {
            $rules['gallery.' . $index] = 'mimes:jpeg,png|max:1500';
            $messages['gallery.' . $index . '.mimes'] = 'Тип изображение должен быть jpeg или png';
            $messages['gallery.' . $index . '.max'] = 'Изображение не может быть больше 1.5 мегабайт';
        }

        $this->validate($request, $rules, $messages);

        if(Auth::user())
        {
            $product = new Product();
            $product->title = $request['title'];
            $product->alias = uniqid($slug->makeSlug($request['title']).'-',false);
            $product->price = $request['price'];
            $product->description = $request['description'];
            $product->category_id = $request['category_id'];
            $product->condition_id = $request['condition'];
            $product->size_id = $request['size'];
            $product->image = $uploadimage->uploadImage($request['image']);
            $product->user_id = Auth::user()->id;
            $product->active = $request['checked']?'1':'0';

            $product->save();
            $uploadimage->uploadGallery($request['gallery'], $product->id);

            return redirect()->route('myprofile.index');
        }
        return redirect()->route('login.index');
    }

    public function editProduct($alias)
    {
        $product = Product::where('alias', $alias)->first();
        if($product->first() != NULL)
        {
            if(Auth::user())
            {
                if(Auth::user()->id == $product->user_id)
                {
                    $images = Gallery::where('product_id', $product->id)->get();

                    return view('product.edit', ['product' => $product, 'images' => $images]);
                }
                return view('product.wrong');
            }
            return redirect()->route('login.index');
        }
        return redirect()->route('product.index');
    }

    public function updateProduct(Request $request, UploadImage $uploadimage, $alias)
    {


        $this->validate($request, [
            'title' => 'required|regex:/^[(a-zA-Za-zА-Яа-яЁёґєії`´ʼ’ʼ"&-.\'’Z0-9\s)]+$/u',
            'price' => 'required|integer',
            'description' => 'required'
        ], [
            'title.required' => 'Необходимо заполнить заголовок',
            'title.regex' => 'Заголовок может содержать только буквы и цифры',
            'price.required' => 'Необходимо указать цену',
            'price.integer' => 'Поле цена должно иметь корректное целочисленное значение',
            'description.required' => 'Добавьте описание для товара'
        ]);

        if(Auth::user())
        {
            $product = Product::where('alias', $alias)->first();
            $product->title = $request['title'];
            $product->price = $request['price'];
            $product->description = $request['description'];
            $product->category_id = $request['category_id'];
            $product->condition_id = $request['condition'];
            $product->size_id = $request['size'];
            if(!empty($request['image']))
            {
                if($product->image != '/uploads/default/default-placeholder-small.png'){
                    unlink(realpath('.'.$product->image));
                }

                $product->image = $uploadimage->uploadImage($request['image']);
            }
            $product->user_id = Auth::user()->id;
            $product->active = $request['checked']?'1':'0';
            $product->timestamps = false;
            $product->update();

            $images = $request->gallery;
            $oldimages = $request->oldgallery;

            /* удаляем старые изображения */
            if(!empty($oldimages))
            {
                foreach ($oldimages as $oldimage)
                {
                    if(!empty($oldimage))
                    {
                        if($oldimage != '/uploads/default/default-placeholder-big.png'){
                            unlink(realpath('.'.$oldimage));
                        }
                    }

                }
            }

            /* перезаписываем путь к изображению */
            $gallery = Gallery::where('product_id', $product->id)->get();

            foreach($gallery as $key => $image)
            {
                if(!empty($images[$key]))
                {
                   $image->image_path = $uploadimage->editGallery($images[$key]);
                   $image->update();
                }

            }
            return redirect()->back();
        }
        return redirect()->route('login.index');
    }

    public function showProduct($alias)
    {
        if(count(Product::select('id')->where('alias','=',$alias)->get())>0)
        {
            $product = Product::where('alias','=',$alias)->with('size')->with('category')->with('condition')->with('user')->first();
            $galleries = Gallery::select('image_path')->where('product_id', $product->id)->get();
            return view('product.item', ['product' => $product, 'galleries' => $galleries]);
        }
        return response()->view('errors.404', [], 404);
    }

    public function updateProductDate($alias)
    {
        $currentDate = new \DateTime();
        $currentDate = $currentDate->format('Y-m-d H:i:s');

        $token = Input::get('token');

        $product = Product::where('alias', '=', $alias)->first();

        if($product){
            if($token == $product->token){
                /**
                 * генерируем новый токен
                 */
                $token = hash_hmac('sha256', str_random(40), config('app.key'));

                $product->updated_at = $currentDate;
                $product->token = $token;
                $product->update();

                return view('notification.success-update-product');
            }
            return view('notification.error-update-product');
        }
        return view('notification.deleted-product');
    }

    public function test(CleanProductsService $cleanProducts)
    {
        $currentDate = new \DateTime();
        $currentDate->modify('-30 day');
        $date = $currentDate->format('Y-m-d');
    }
}
