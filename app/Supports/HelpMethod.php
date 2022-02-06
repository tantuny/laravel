<?php
namespace App\Supports;
class HelpMethod{
    public static function base64_to_image($base64_string){
// split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );
    $image_info = getimagesize($base64_string);
    $extension = (isset($image_info["mime"]) ? explode('/', $image_info["mime"] )[1]: "");
     if(!is_dir('storage/contentImage')){
        mkdir('storage/contentImage', 0700, true); 
     }
    $output_file = 'storage/contentImage/'.time().'.'.$extension;
    $ifp = fopen( $output_file, 'xb' );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp );

    return '/'.$output_file;
}
}