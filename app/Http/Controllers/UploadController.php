<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        $pasien = Pasien::where(
            'no_rkm_medis',
            request('no_rkm_medis')
        )->first();

        if (!$pasien) {
            return redirect('/');
        }
        return view('content.upload', [
            'upload' => $this->showUpload(request('no_rawat')),
            'no_rawat' => request('no_rawat'),
            'tgl_masuk' => request('tgl_masuk'),
            'no_rkm_medis' => $pasien->no_rkm_medis,
            'nm_pasien' => $pasien->nm_pasien,
            'tgl_lahir' => $pasien->tgl_lahir,
            'alamat' => $pasien->alamat,
        ]);
    }

    public function showUpload(Request $request)
    {
        $upload = Upload::where('no_rawat', $request->no_rawat)
            ->where('kategori', $request->kategori)
            ->first();
        return response()->json($upload);
    }
    public function upload(Request $request)
    {
        $no_rkm_medis = $request->no_rkm_medis;
        $no_rawat = $request->no_rawat;
        $tgl_masuk = $request->tgl_masuk;
        $username = $request->username;
        $kategori = $request->kategori;


        $txt_no_rawat = str_replace('/', '', $no_rawat);

        $arrNama = [];
        foreach ($request->images as $images) {
            $image_parts[] = explode(';base64,', $images);
            foreach ($image_parts as $parts) {
                if ($parts[0] == 'data:application/pdf') {
                    $image_type_aux = explode('application/', $parts[0]);
                } else {

                    $image_type_aux = explode('image/', $parts[0]);
                }
                $image_base64[] = base64_decode($parts[1]);
            }

            $image_type[] = $image_type_aux[1];
            foreach ($image_type as $type) {
                foreach ($image_base64 as $base) {
                    $base = base64_decode($parts[1]);
                }
            }
            $name = $txt_no_rawat . '-' . $kategori . '-' . rand(10, 9999) . '.' . $type;
            array_push($arrNama, $name);
            $storage = Storage::disk('public_upload')->put(
                'erm/' . $name,
                $base
            );


            if ($image_type_aux[1] != 'pdf') {
                $info = getimagesize('public/erm/' . $name);
                $filesize = filesize('public/erm/' . $name);

                if ($info['mime'] == 'image/jpeg') {
                    $image = imagecreatefromjpeg('public/erm/' . $name);
                } elseif ($info['mime'] == 'image/png') {
                    $image = imagecreatefrompng('public/erm/' . $name);
                } elseif ($info['mime'] == 'image/gif') {
                    $image = imagecreatefromgif('public/erm/' . $name);
                }

                // if ($info[0] > $info[1]) {
                //     $imageRotate = imagerotate($image, 90, 0);
                // } else {
                //     $imageRotate = imagerotate($image, 0, 0);
                // }

                if ($filesize > 500000) {
                    $imageInfo[] = imagejpeg($image, 'public/erm/' . $name, 15);
                } else {
                    $imageInfo[] = imagejpeg($image, 'public/erm/' . $name, 80);
                }
            }
        }
        // return $name;
        $fileName = implode(',', $arrNama);

        $isUploaded = Upload::where('no_rawat', $no_rawat)->where(
            'kategori',
            $kategori
        );
        if (!$isUploaded->first()) {
            $upload = Upload::create([
                'file' => $fileName,
                'no_rkm_medis' => $no_rkm_medis,
                'no_rawat' => $no_rawat,
                'tgl_masuk' => $tgl_masuk,
                'username' => $username,
                'kategori' => $kategori,
            ]);
        } else {
            $files = $isUploaded->first()->file;
            $arrFiles = explode(',', $files);
            array_push($arrFiles, $fileName);
            $textFile = implode(',', $arrFiles);
            $upload = $isUploaded->update([
                'file' => $textFile,
            ]);
        }

        return response()->json($upload);
    }
    public function delete($id, Request $request)
    {
        $upload = Upload::select('file')
            ->where('id', $id)
            ->first();

        $file = $upload->file;
        $path = public_path("/erm/$request->image");
        if ($path) {
            unlink($path);
        }
        $arrFile = explode(',', $file);
        $key = array_search($request->image, $arrFile);
        unset($arrFile[$key]);
        $files = implode(',', $arrFile);
        if (!$files) {
            Upload::where('id', $id)->delete();
        } else {
            Upload::where('id', $id)->update([
                'file' => $files,
            ]);
        }
        return response()->json([
            'message' => 'Berhasil hapus gambar',
        ]);
    }
    public function ambilPeriksa(Request $request)
    {
        $upload = Upload::where('no_rawat', $request->no_rawat)->with('regPeriksa.pasien')->get();
        return response()->json($upload);
    }
}
