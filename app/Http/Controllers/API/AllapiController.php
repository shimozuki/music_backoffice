<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AboutModel;
use App\Models\Post;
use App\Models\SejarahumumModel;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AllapiController extends Controller
{
    public function musikall()
    {
        $data = Post::where('status', 1)->get();
        if (!empty($data)) {
            $response = [
                'status' => 200,
                'error' => false,
                'message' => 'Success get data',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => 'No Entry Data',
                'data' => []
            ];
        }
        return response()->json($response);
    }

    public function getabout()
    {
        $data = AboutModel::all();
        if (!empty($data)) {
            $response = [
                'status' => 200,
                'error' => false,
                'message' => 'Success get data',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => 'No Entry Data',
                'data' => []
            ];
        }
        return response()->json($response);
    }

    public function sejarah()
    {
        $data = SejarahumumModel::all();
        if (!empty($data)) {
            $response = [
                'status' => 200,
                'error' => false,
                'message' => 'Success get data',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => 'No Entry Data',
                'data' => []
            ];
        }
        return response()->json($response);
    }

    public function getbyid(Request $request)
    {
        $id = $request->id;
        $data = Post::find($id);
        if (!empty($data)) {
            $response = [
                'status' => 200,
                'error' => false,
                'message' => 'Success get data',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => 'No Entry Data',
                'data' => []
            ];
        }
        return response()->json($response);
    }

    public function upload(Request $request)
    {
        $nama_alat = $request->nama_alat;
        $whatsapp = $request->whatsapp;
        $nama = $request->nama;
        $email = $request->email;
        $link = $request->link;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();  // Get the original file extension
            $imageName = time() . '_' . uniqid() . '.' . $extension;  // Generate a unique file name with the original extension
            $image->move(public_path('post-images'), $imageName);
        
            $image_path = 'post-images/' . $imageName;
        }
        try {
            
            $path1 = $request->file('select_file')->store('temp');
            $path = storage_path('app') . '/' . $path1;

            $collection = Excel::toCollection(new Post(), $path);
            $dataReq =  $collection->toArray();
            $headings = array_shift($dataReq[0]);

            array_walk(
                $dataReq[0],
                function (&$row) use ($headings) {
                    $row = array_combine($headings, $row);
                    if (count($headings) > 4) {
                        unset($row['']);
                        unset($headings[4]);
                        if (count($headings) != 4) {
                            if ($row['STATUS']) {
                                unset($row['STATUS']);
                            }
                            if ($row['MESSAGE'] != null || $row['MESSAGE'] == null) {
                                unset($row['MESSAGE']);
                            }
                        }
                    }
                }
            );

            array_walk_recursive($dataReq[0], function (&$row) {
                if (is_numeric($row)) {
                    $row = strval($row);
                }
            });

            $objData = $dataReq[0];

            $chunks = array_chunk($objData, 100);

            foreach ($chunks as $key => $chunk) {
                foreach ($chunk as &$record) {
                    $user = User::create([
                        'name' => $nama, // Assuming 'nama' is the field in the user table
                        'email' => $email,
                        'username' => $nama,
                        'whatsapp' =>  $whatsapp,// Assuming 'email' is the field in the user table
                    ]);
                    $lastInsertedUserId = $user->id;
                    $record['nama_alat'] = $nama_alat;
                    $record['image'] = $image_path;
                    $record['user_id'] = $lastInsertedUserId;
                    $record['status'] = 0;
                    $record['link'] = $link;
                    $record['created_at'] = date('Y-m-d H:i:s');
                    $record['updated_at'] = date('Y-m-d H:i:s');
                }

                Post::insert($chunk);
            }
            $response = [
                'status' => 200,
                'error' => false,
                'message' => 'Data Uploaded Successfully!',
                'data' => []
            ];
            return $response;
        } catch (\Throwable $th) {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => 'Please make sure the file is correct for Product User Mapping !',
                'data' => []
            ];
            return $response;
        }
    }


}
