<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Facturas',
            'Lista de facturas',
            'Facturas pagadas',
            'Facturas pagadas parcialmente',
            'Facturas no pagadas',
            'Archivo de facturas',
            'Informes',
            'Informe de facturas',
            'Informe de clientes',
            'Usuarios',
            'Lista de usuarios',
            'Permisos de usuarios',
            'Ajustes',
            'Productos',
            'Secciones',

            'Agregar factura',
            'Eliminar factura',
            'EXCEL exportacion',
            'Cambiar estado de pago',
            'Modificar factura',
            'Archivar factura',
            'Imprimir factura',
            'Agregar adjunto',
            'Eliminar adjunto',

            'Agregar usuario',
            'Modificar usuario',
            'Eliminar usuario',

            'Mostrar role',
            'Agregar role',
            'Modificar role',
            'Eliminar role',

            'Agregar producto',
            'Modificar producto',
            'Eliminar producto',

            'Agregar seccion',
            'Modificar seccion',
            'Eliminar seccion',

            'Notificaciones',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
