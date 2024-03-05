<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Caja;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Compras;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FuncionesVentaController extends Controller
{
    /*
    * ----------------------------------
    * Esta función esta diseñado para encontrar
    * el ultimo registro de la tabla cajaDía relacionada con
    * el usuario.
    * -------------------------------------
    * Retorna el registro de cajaDIa.
    * ----------------------------------
    */
    public function cajaDiaUsuario(){
        $usuario = Auth::user();

        $usuario = User::findOrFail($usuario->id);

        $caja_dia = DB::select('SELECT cajadia.* FROM cajadia 
                    JOIN users ON users.id = cajadia.id_usuario 
                    WHERE cajadia.id_usuario = ' . $usuario->id . ' ORDER BY cajadia.id DESC LIMIT 1');

        if (!empty($caja_dia)) {
            $caja_dia = $caja_dia[0]; // Obtener el primer resultado
        }else{
            $caja_dia = [];
        }

        return $caja_dia;
    }

    /*
    * --------------------------------------------------------------
    * Esta función esta diseñada para encontrar la caja relacionada
    * con el cajaDia mediante el num_caja_dia.
    * --------------------------------------------------------------
    * Parametros: Recibe caja_dia.
    * --------------------------------------------------------------
    * returna la caja que esta utilizando el usuario.
    * --------------------------------------------------------------
    */
    public function encontrarCajaUsuario($caja_dia){
        
        if($caja_dia == null){
            $caja = [];

        }else{
            $caja = Caja::select('caja.*', 'cajadia.id as id_caja_dia')
            ->join('cajadia', 'caja.id', '=', 'cajadia.id_caja')
            ->where('num_caja_dia', $caja_dia->id)
            ->first();
        }

        return $caja;
    }

    /*
    * -------------------------------------------------
    * Almacenar subtotal y cantidad dentro de la venta.
    * -------------------------------------------------
    * No retorna nada, solamente almacena en la base
    * de datos.
    * -------------------------------------------------
    */
    public function almacenarVentas($venta, $codigoProductos, $cantidadProductos, $subtotales){
        $dimension = count($codigoProductos);
        $productos = [];

        for($i = 0; $i < $dimension; $i++){
            $producto = Producto::where('codigo', $codigoProductos[$i])->firstOrFail();
            $productos[] = $producto;

            $venta->detalle_venta()->attach($producto, [
                'cantidad' => $cantidadProductos[$i],
                'subtotal' => $subtotales[$i],
            ]);
        }
    }

    /*
    * Encontrar los productos para la facturacion
    * 
    */
    public function encontrarProductoFacturacion($id_venta){
        $productos = DB::select('SELECT productos.*, detalleventa.* FROM ventas
                    JOIN detalleventa ON ventas.id = detalleventa.id_ventas
                    JOIN productos ON detalleventa.id_productos = productos.id
                    WHERE detalleventa.id_ventas = ' . $id_venta);

        return $productos;
    }

     /*
    * Encontrar la compra para la facturacion
    * 
    */
    public function encontrarCompraFacturacion($id_compra){
        $productos = DB::select('SELECT productos.*, proveedor.* FROM compras
                    JOIN proveedor ON compras.id = proveedor.id_compras
                    JOIN productos ON proveedor.id_productos = productos.id
                    WHERE proveedor.id_compras = ' . $id_compra);

        return $productos;
    }
}
