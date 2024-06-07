<?php
namespace App\Http;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AzureBlobStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function addUserData(Request $request)
    {
        
        if(User::create($request->all())){
            return response()->json(['status'=>200,'res'=>'success']);
        }else{
            return response()->json(['status'=>400,'res'=>'Failed to store!']);
        }
    }
    public function storeImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required'
         ]);
         if ($validator->fails()) {
            // return sendCustomResponse($validator->messages()->first(),  'error', 500);
            return response()->json(['status'=>403,'res'=>$validator->messages()->first()]);
         }
         $file = $request->file('image');
         $azureBlobStorage = new AzureBlobStorage();
         $res = $azureBlobStorage->uploadImage($file, '/users');
         Log::info($res);
     
        //  $uploadFolder = 'users';
        //  $image = $request->file('image');
        //  $image_uploaded_path = $image->store($uploadFolder, 'public');
        //  $uploadedImageResponse = array(
        //     "image_name" => basename($image_uploaded_path),
        //     "image_url" => Storage::disk('public')->url($image_uploaded_path),
        //     "mime" => $image->getClientMimeType()
        //  );
         $data = $request->all();
         $data['image'] = $res;
         try {
            User::create($data);
         } catch (\Throwable $th) {
            Log::info($th);
         }
         
        //  return sendCustomResponse('File Uploaded Successfully', 'success',   200, $uploadedImageResponse);
        return response()->json(['status'=>200]);
    }
    public function getUser(Request $request)
    {
        return response()->json([
            'status'=>200,
            'res'=>'test'
        ]);
    }
}

?>