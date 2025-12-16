<?php

namespace App\Http\Controllers;

// Agregar el modelo Evento
use App\Models\Evento;
// Agregar la clase Request para manejar las peticiones
use Illuminate\Http\Request;
// Agregar la clase Validator para validar los datos de la petición
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource (GET /api/eventos).
     */
    public function index()
    {
        // Retrieve all resources
        $eventos = Evento::all();
        
        // Return retrieved resources
        $respuesta = [
            'eventos' => $eventos,
            'status' => 200,
        ];
        return response()->json($respuesta);
    }

    /**
     * Store a newly created resource in storage (POST /api/eventos).
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ubicacion' => 'required',
        ]);
        
        // If validation fails, return 400 Bad Request
        if ($validator->fails()) {
            $respuesta = [
                'message' => 'Datos faltantes',
                'status' => 400,
            ];
            return response()->json($respuesta, 400);
        }

        // Create the new resource
        $evento = Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ubicacion' => $request->ubicacion,
        ]);

        // If creation failed, return 500 Internal Server Error
        if (!$evento) {
            $respuesta = [
                'message' => 'Error al crear el evento',
                'status' => 500,
            ];
            return response()->json($respuesta, 500);
        }

        // Return the created resource (201 Created)
        $respuesta = [
            'evento' => $evento,
            'status' => 201,
        ];
        return response()->json($respuesta, 201);
    }

    /**
     * Display the specified resource (GET /api/eventos/{id}).
     */
    public function show($id)
    {
        // Find the specified resource
        $evento = Evento::find($id);
        
        // If resource is not found, return 404 Not Found
        if (!$evento) {
            $respuesta = [
                'message' => 'Evento no encontrado',
                'status' => 404,
            ];
            return response()->json($respuesta, 404);
        }
        
        // Return the retrieved resource (200 OK)
        $respuesta = [
            'evento' => $evento,
            'status' => 200,
        ];
        return response()->json($respuesta);
    }

    /**
     * Update the specified resource in storage (PUT /api/eventos/{id}).
     */
    public function update(Request $request, $id)
    {
        // Find the resource
        $evento = Evento::find($id);

        // If resource is not found, return 404 Not Found
        if (!$evento) {
            $respuesta = [
                'message' => 'Evento no encontrado',
                'status' => 404,
            ];
            return response()->json($respuesta, 404);
        }

        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'titulo' => 'required', 
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ubicacion' => 'required',
        ]);
        
        // If validation fails, return 400 Bad Request
        if ($validator->fails()) {
            $respuesta = [
                'message' => 'Datos faltantes',
                'status' => 400,
            ];
            return response()->json($respuesta, 400);
        }

        // Update the specified resource
        $evento->titulo = $request->titulo;
        $evento->descripcion = $request->descripcion;
        $evento->fecha_inicio = $request->fecha_inicio;
        $evento->fecha_fin = $request->fecha_fin;
        $evento->ubicacion = $request->ubicacion;
        $evento->save();

        // Return the updated resource (200 OK)
        $respuesta = [
            'evento' => $evento,
            'status' => 200,
        ];
        return response()->json($respuesta);
    }

    /**
     * Remove the specified resource from storage (DELETE /api/eventos/{id}).
     */
    public function destroy($id)
    {
        // Find the resource
        $evento = Evento::find($id);
        
        // If resource is not found, return 404 Not Found
        if (!$evento) {
            $respuesta = [
                'message' => 'Evento no encontrado',
                'status' => 404,
            ];
            return response()->json($respuesta, 404);
        }
        
        // Delete the specified resource
        $evento->delete();
        
        // Return success message (200 OK)
        $respuesta = [
            'message' => 'Evento eliminado',
            'status' => 200,
        ];
        return response()->json($respuesta);
    }
}