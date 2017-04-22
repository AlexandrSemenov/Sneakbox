<?php
namespace App\Classes;
use App\Models\Gallery;

class UploadImage
{
    public function uploadImage($image)
    {
        if($image)
        {
            //текущая дата
            $current_year = date("Y");
            $current_month = date("m");
            $current_day = date("d");

            $file = $image;

            //Свойства изображения
            $image_ext = $file->getClientOriginalExtension();
            $image_error = $file->getError();
            $image_size = $file->getClientSize();
            $image_mime_type = $file->getMimeType();

            //Доступные расширения файлов
            $allowed = array('jpg', 'png', 'jpeg');

            if(in_array($image_ext, $allowed)){

                if($image_error === 0){
                    if($image_size <= 2097152){
                        $image_name_new = uniqid('img-', false) . '.' . $image_ext;
                        $image_destination = "uploads/$current_year/$current_month/$current_day/";
                        $upload_dir = "uploads/$current_year/$current_month/$current_day/";

                        if(!is_dir($upload_dir)){
                            $old = umask(0);
                            mkdir($upload_dir, 0777, true);
                            umask($old);
                        }
                        if($file->move($image_destination, $image_name_new)){
                            // ширина и высота нового изображения
                            $width = 200;
                            $height = 200;

                            // получение новых размеров
                            $image_location = $image_destination . $image_name_new;
                            list($width_orig, $height_orig) = getimagesize($image_location);

                            $src_x = ($width_orig > $height_orig)? ($width_orig-$height_orig)/2 : 0;

                            // прировнять высоту и ширину изображения
                            if($width_orig < $height_orig){
                                $height_orig = $width_orig;
                            }else{
                                $width_orig = $height_orig;
                            }

                            $ratio_orig = $width_orig/$height_orig;

                            //ресайз изображения
                            if ($width/$height > $ratio_orig) {
                                $width = $height*$ratio_orig;
                            } else {
                                $height = $width/$ratio_orig;
                            }

                            if($image_mime_type == "image/jpeg" || $image_mime_type == "image/pjpeg" ){
                                //получить id изображениея
                                $image_old = imagecreatefromjpeg($image_location);

                            }elseif($image_mime_type == "image/png"){
                                $image_old = imagecreatefrompng($image_location);
                            }

                            //создать новое изображение
                            $image_new = imagecreatetruecolor($width,$height);

                            //копировать и изменить размеры изображения
                            imagecopyresampled($image_new,$image_old, 0, 0, $src_x, 0,$width,$height,$width_orig,$height_orig);
                            //сохранить новое изображение
                            imagejpeg($image_new, $image_location, 90);

                            return "/uploads/$current_year/$current_month/$current_day/" . $image_name_new;
                        }else{
                            dd('изображение не загруженно');
                        }
                    }
                }
            }
        }else{
            return "/uploads/default/default-placeholder-small.png";
        }
    }

    public function uploadGallery($gallery, $product_id)
    {
        if($gallery[0] != NULL)
        {
            //текущая дата
            $current_year = date("Y");
            $current_month = date("m");
            $current_day = date("d");

            $images = $gallery;


            foreach($images as $image)
            {
                if($image != NULL)
                {
                    $image_ext = $image->getClientOriginalExtension();

                    $new_image_name = uniqid('img-', false) . '.' . $image_ext;
                    $image_destination = "uploads/$current_year/$current_month/$current_day/";
                    $upload_dir = "uploads/$current_year/$current_month/$current_day/";

                    if(!is_dir($upload_dir)){
                        mkdir($upload_dir, 0777, true);
                    }
                    if($image->move($image_destination, $new_image_name)){
                        $gallery = new Gallery;
                        $gallery->image_path = '/'.$image_destination . $new_image_name;
                        $gallery->product_id = $product_id;
                        $gallery->save();
                    }else{
                        dd('что то пошло не так');
                    }
                }

            }
        }else{
            $gallery = new Gallery;
            $gallery->image_path = "/uploads/default/default-placeholder-big.png";
            $gallery->product_id = $product_id;
            $gallery->save();
        }

    }
    public function editGallery($image)
    {
        //текущая дата
        $current_year = date("Y");
        $current_month = date("m");
        $current_day = date("d");


        if($image != NULL)
        {
            $image_ext = $image->getClientOriginalExtension();
            $new_image_name = uniqid('img-', false) . '.' . $image_ext;
            $image_destination = "uploads/$current_year/$current_month/$current_day/";
            $upload_dir = "uploads/$current_year/$current_month/$current_day/";

            if(!is_dir($upload_dir)){
                mkdir($upload_dir, 0777, true);
            }

            $image->move($image_destination, $new_image_name);
            $image_path = "/uploads/$current_year/$current_month/$current_day/" . $new_image_name;

            return $image_path;
        }
    }

}