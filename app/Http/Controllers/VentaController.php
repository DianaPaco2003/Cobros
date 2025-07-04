<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;//exportacion
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class VentaController extends Controller
{
        public function index()
    {
        $ventas = Venta::with(['usuario', 'detalles.producto'])->get();
        return Inertia::render('Ventas/Index', [
            'ventas' => $ventas
        ]);
    }

    public function create()
    {
        $productos = Producto::all();
        $usuarios = \App\Models\Usuario::all();
        return Inertia::render('Ventas/Create', [
            'productos' => $productos,
            'usuarios' => $usuarios
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_nombre' => 'required|string|max:255',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            //$user = auth()->user();
            $user = Auth::user(); //cambiamos aqui el de arriba
            if (!$user) {
                return back()->with('error', 'No hay usuario autenticado.');
            }

            $venta = new Venta();
            $venta->cliente_nombre = $request->cliente_nombre;
            $venta->usuario_id = $user->id;
            $venta->total = 0;
            $venta->save();

            $total = 0;

            foreach ($request->productos as $item) {
                $producto = Producto::findOrFail($item['id']);
                
                $detalle = new DetalleVenta();
                $detalle->venta_id = $venta->id;
                $detalle->producto_id = $producto->id;
                $detalle->producto_nombre = $producto->nombre;
                $detalle->producto_precio = $producto->precio;
                $detalle->cantidad = $item['cantidad'];
                $detalle->subTotal = $producto->precio * $item['cantidad'];
                $detalle->save();

                $total += $detalle->subTotal;
            }

            $venta->total = $total;
            $venta->save();

            DB::commit();

            return redirect()->route('ventas.index')
                ->with('success', 'Venta registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Venta $venta)
    {
        $venta->load(['usuario', 'detalles.producto']);
        return Inertia::render('Ventas/Show', [
            'venta' => $venta
        ]);
    }

    public function destroy(Venta $venta)
    {
        try {
            DB::beginTransaction();
            
            $venta->detalles()->delete();
            $venta->delete();
            
            DB::commit();
            
            return redirect()->route('ventas.index')
                ->with('success', 'Venta eliminada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al eliminar la venta: ' . $e->getMessage());
        }
    }
}