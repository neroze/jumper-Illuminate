<?php

namespace Jumper\Core\Helpers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait FileUploadTrait
{
    /**
     * @param Request $request
     * @param string  $dir     directive name to store file
     *                         File upload trait used in controllers to upload files
     */
    public function saveFiles(Request $request, $dir = null)
    {
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        ini_set('max_input_time', 300);
        ini_set('max_execution_time', 300);
        $path = public_path('uploads').'/';
        $resp = [];
        if ($dir != null) {
            if (!file_exists(public_path('uploads').'/'.$dir)) {
                mkdir(public_path('uploads/'.$dir), 0777);
            }
            $path = public_path('uploads/'.$dir.'/');
        } elseif (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0777);
           // mkdir(public_path('uploads/thumb'), 0777);
        }
        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {
                if ($request->has($key.'_w') && $request->has($key.'_h')) {
                    // Check file width
                    $filename = time().'-'.$request->file($key)->getClientOriginalName();
                    $file = $request->file($key);
                    $image = Image::make($file);
                    Image::make($file)->resize(50, 50)->save(public_path('uploads/thumb').'/'.$filename);
                    $width = $image->width();
                    $height = $image->height();
                    if ($width > $request->{$key.'_w'} && $height > $request->{$key.'_h'}) {
                        $image->resize($request->{$key.'_w'}, $request->{$key.'_h'});
                    } elseif ($width > $request->{$key.'_w'}) {
                        $image->resize($request->{$key.'_w'}, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } elseif ($height > $request->{$key.'_w'}) {
                        $image->resize(null, $request->{$key.'_h'}, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    $image->save($path.$filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                } else {
                    $filename = time().'-'.$request->file($key)->getClientOriginalName();
                    $request->file($key)->move($path, $filename);
                    $request = new Request(array_merge($request->all(), [$key => $filename]));
                }
                $resp['file_name'] = $filename;
            }
        }

        return $resp;
    }
}
