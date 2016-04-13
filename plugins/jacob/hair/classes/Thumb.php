<?php namespace Jacob\Hair\Classes;

use Backend;
use System\Classes\PluginBase;
use Config;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;

class Thumb
{

    public static function make($img, $width, $height)
    {
        $quality = 90;
        // Add slash at the beginning if omitted
        if(substr($img, 0, 1) != '/'){
          $img = '/'.$img;
        }

        $disk = config('cms.storage.media.disk');
        $disk_folder = config('cms.storage.media.folder');
        $disk_path = config('cms.storage.media.path');
        
        $original_path = $disk_folder.$img;
        
        // return empty String if file does not exist
        if(!Storage::disk($disk)->exists($original_path)){
            return '';
        }
        
        // get the image as data
        $original_file = Storage::disk($disk)->get($original_path);

        // define directory for thumbnail
        $thumb_directory = $disk_folder.'/_mediathumbs/';

        // make new filename for folder names and filename
        $new_filename = str_replace('/', '-', substr($img, 1));

        // store position of the dot before the extension
        $last_dot_position = strrpos($new_filename, '.');

        //get the extension
        $extension = substr($new_filename, $last_dot_position+1);

        //get the new filename without extension
        $filename_body = substr($new_filename, 0, $last_dot_position);

        // get filesize and filetime for extending the filename for the purpose of
        // creating a new thumb in case a new file with the same name is uploaded
        // (meaning the orginal file is overwritten)
        $filesize = Storage::disk($disk)->size($original_path);
        $filetime = Storage::disk($disk)->lastModified($original_path);

        // make the string to add to the filname to for 2 purposes:
        // A) to make sure the that for the SAME image a thumbnail is only generated once
        // b) to make sure that a new thumb is generated if the original is overwritten
        $version_string = 'fit-'.$width.'-'.$height.'-'.$quality.'-'.$filesize.'-'.$filetime;

        // create the complete new filename and hash the version string to make it shorter
        $new_filename = $filename_body.'-'.md5($version_string).'.'.$extension;

        // define complete path of the new file (without the root path)
        $new_path = $thumb_directory.$new_filename;

        
        // create the thumb directory if it does not exist
        if(!Storage::disk($disk)->exists($thumb_directory)){
            Storage::disk($disk)->makeDirectory($thumb_directory);
        }
        
        // create the thumb, but only if it does not exist
        if(!Storage::disk($disk)->exists($new_path)){

            $image = Image::make($original_file);

            $image->fit($width, $height);

            // $final_mode = $mode;
            // if($mode == 'auto'){
            //     $final_mode = 'width';
                
            //     $ratio = $image->width()/$image->height();
            //     if($ratio < 1){
            //         $final_mode = 'height';
            //     }
            // }
            // if($final_mode == 'width'){
            //     $image->resize($size, null, function ($constraint) {
            //         $constraint->aspectRatio();
            //         $constraint->upsize();
            //     });
            // }
            // elseif($final_mode == 'height'){
            //     $image->resize(null, $size, function ($constraint) {
            //         $constraint->aspectRatio();
            //         $constraint->upsize();
            //     });
            // }
            $image_stream = $image->stream($extension, $quality);
            Storage::disk($disk)->put($new_path, $image_stream->__toString());
           
        }

        return $disk_path.'/_mediathumbs/'.$new_filename;
    }

}
