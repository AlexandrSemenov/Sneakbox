<?php

namespace App\Components;

use Mail;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Support\Facades\Config;

class CleanProductsService
{
    protected $notificationDate;
    protected $productsNotification;
    protected $emailComponents;
    protected $deleteDate;
    protected $productsDelete;
    protected $url;

    public function __construct()
    {
        $this->notificationDate = $this->getNotificationDate();
        $this->productsNotification = $this->getProductsForNotification();
        $this->emailComponents = $this->emailComponents();
        $this->deleteDate = $this->getDeleteEmailDate();
        $this->productsDelete = $this->getProductsForDelete();
        $this->url = Config::get('app.url');
    }

    public function getNotificationDate()
    {
        $currentDate = new \DateTime();
        $currentDate->modify('-30 day');
        $date = $currentDate->format('Y-m-d');
        return $date;
    }

    public function getDeleteEmailDate()
    {
        $currentDate = new \DateTime();
        $currentDate->modify('-40 day');
        $date = $currentDate->format('Y-m-d');
        return $date;
    }

    public function getProductsForNotification()
    {
        $products = Product::where('updated_at', 'like', $this->notificationDate.'%')->with('user')->get();
        return $products;
    }

    public function getProductsForDelete()
    {
        $products = Product::where('updated_at', 'like', $this->deleteDate.'%')->with('user')->get();
        return $products;
    }

    public function generateToken()
    {
        $token = hash_hmac('sha256', str_random(40), config('app.key'));
        return $token;
    }

    public function emailComponents()
    {
        $components = [];

        foreach($this->productsNotification as $product){
            $token = $this->generateToken();

            $product = Product::where('id', '=', $product->id)->first();
            $product->token = $token;
            $product->timestamps = false;
            $product->update();

            $components[] = [
                'name' => $product->user->name,
                'email' => $product->user->email,
                'slug' => $product->alias,
                'token' => $token,
                'url' => $this->url
            ];
        }
        return $components;
    }

    public function sendEmailNotification()
    {
        if(count($this->emailComponents) > 0){
            foreach($this->emailComponents as $email){
                Mail::send('email.renewal', array('email' => $email), function($message) use ($email){
                    $message->from('info.sneakbox@gmail.com', 'Sneak.Box info');
                    $message->to($email['email'], $email['name'])->subject('Ваше объявление будет удалено через 10 дней');
                });
            }
        }
    }

    public function deleteOldProducts()
    {
        if(count($this->productsDelete) > 0){
            /**
             * TODO удаление объявлений у которых срок последнего обновления привысил 30 дней
             */
            foreach ($this->productsDelete as $product) {
                $this->deleteImage($product);
                $product->delete();
            }
        }
    }

    protected function deleteImage($product)
    {
        $images = $this->getGalleryImages($product);
        foreach($images as $image){
            if($image->image_path != '/uploads/default/default-placeholder-big.png' && $image->image_path != '/uploads/default/default-placeholder-small.png'){
                unlink('public' . $image->image_path);
            }
        }
        if($product->image != '/uploads/default/default-placeholder-small.png'){
            unlink('public' . $product->image);
        }
    }

    protected function getGalleryImages($product)
    {
        $gallery = Gallery::where('product_id', '=', $product->id)->get();
        return $gallery;
    }
}