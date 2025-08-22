<?php

namespace App\Http\Controllers;

use App\Models\MHewan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class HewanController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/v1/hewan",
     *     summary="Get all Hewan records",
     *     tags={"Hewan"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Hewan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function allHewan(): JsonResponse
    {
        try {
            $hewan = MHewan::all();
            return response()->json($hewan, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="api/v1/hewan/{id}",
     *     summary="Get a specific Hewan by ID",
     *     tags={"Hewan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Hewan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Hewan")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hewan not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Hewan not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function detailHewan($id): JsonResponse
    {
        try {
            $hewan = MHewan::find($id);
            if (!$hewan) {
                return response()->json(['message' => 'Hewan not found'], 404);
            }
            return response()->json($hewan, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="api/v1/hewan",
     *     summary="Create a new Hewan",
     *     tags={"Hewan"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Sapi"),
     *             @OA\Property(property="icon_path", type="string", example="/icons/sapi.png"),
     *             @OA\Property(property="is_aktif", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Hewan created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Hewan")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function storeHewan(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'icon_path' => 'required|string|max:255',
                'is_aktif' => 'required|boolean',
            ]);

            $hewan = MHewan::create($validated);
            return response()->json($hewan, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="api/v1/hewan/{id}",
     *     summary="Update an existing Hewan",
     *     tags={"Hewan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Hewan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Sapi"),
     *             @OA\Property(property="icon_path", type="string", example="/icons/sapi.png"),
     *             @OA\Property(property="is_aktif", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hewan updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Hewan")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hewan not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Hewan not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function updateHewan(Request $request, $id): JsonResponse
    {
        try {
            $hewan = MHewan::find($id);
            if (!$hewan) {
                return response()->json(['message' => 'Hewan not found'], 404);
            }

            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'icon_path' => 'required|string|max:255',
                'is_aktif' => 'required|boolean',
            ]);

            $hewan->update($validated);
            return response()->json($hewan, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="api/v1/hewan/{id}",
     *     summary="Delete a Hewan by ID",
     *     tags={"Hewan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the Hewan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Hewan deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hewan not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Hewan not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function destroyHewan($id): JsonResponse
    {
        try {
            $hewan = MHewan::find($id);
            if (!$hewan) {
                return response()->json(['message' => 'Hewan not found'], 404);
            }

            $hewan->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }
}