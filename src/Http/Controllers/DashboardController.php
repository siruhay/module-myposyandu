<?php

namespace Module\MyPosyandu\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Module\MyPosyandu\Models\MyPosyanduBeneficiary;
use Module\Posyandu\Http\Resources\DocmapResource;
use Module\Posyandu\Models\PosyanduDocmap;
use Module\Posyandu\Models\PosyanduDocument;
use Module\Posyandu\Models\PosyanduService;

class DashboardController extends Controller
{
    /**
     * index function
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request): void
    {
        //
    }

    public function combos(Request $request)
    {
        switch ($request->model) {
            case 'documents':
                return DocmapResource::collection(PosyanduService::find($request->refid)->docmaps->load(['document']));
                break;

            default:
                # code...
                break;
        }
    }

    public function record(Request $request)
    {
        switch ($request->model) {
            case 'beneficiary':
                $beneficiary = MyPosyanduBeneficiary::with(
                    ['biodata', 'biodata.subdistrict', 'biodata.village', 'category', 'community']
                )->firstWhere('slug', $request->refid);

                if (!$beneficiary) {
                    return [];
                }

                return MyPosyanduBeneficiary::mapResource(
                    $request,
                    $beneficiary
                );
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * upload function
     *
     * @param Request $request
     * @return void
     */
    public function upload(Request $request)
    {
        $document = PosyanduDocument::firstWhere('slug', $request->slug);

        if (! $document) {
            return response()->json([
                'status' => 422,
                'message' => 'Upload file tidak valid'
            ], 422);
        }

        $request->validate([
            'file' => "required|file|max:{$document->maxsize}"
        ]);

        if ($request->hasFile('file') && $request->file('file')) {
            $fileslug = $request->user()->email . DIRECTORY_SEPARATOR . $request->slug;
            $filename = $request->uuid . $request->extension;
            $filepath = $fileslug . DIRECTORY_SEPARATOR . $filename;

            if (Storage::disk('uploads')->putFileAs($fileslug, $request->file('file'), $filename)) {
                return response()->json([
                    'path' => $filepath
                ], 200);
            }
        }

        return response()->json([
            'status' => 422,
            'message' => 'Upload file bermasalah'
        ], 422);
    }

    /**
     * download function
     *
     * @param Request $request
     * @return void
     */
    public function download(Request $request)
    {
        if (! str($request->path)->contains($request->user()->email)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

        if (!Storage::disk('uploads')->exists($request->path)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

        return optional(Storage::disk('uploads'))->download($request->path, 'downloaded-file.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="sample.pdf"',
        ]);
    }

    /**
     * destroy function
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        if (! str($request->path)->contains($request->user()->email)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

        if (!Storage::disk('uploads')->exists($request->path)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

        if (Storage::disk('uploads')->delete($request->path)) {
            return response()->json([
                'success' => true,
                'message' => 'Hapus file dari server berhasil.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Hapus file dari server gagal.'
        ], 500);
    }
}
