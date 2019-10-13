<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\DB;


class rolesController extends Controller
{
    public function store(Request $request)
    {
        $rol=new Role;
        $rol->name=$request->input("name") ;
        $rol->slug=$request->input("slug") ;
        $rol->description=$request->input("description") ;
        $rol->save();

        return response()->json([
            'message' => 'Rol creado correctamente'
        ], 201);
    }

    public function nuevorol(){
        //carga el formulario para agregar un nuevo rol
        $roles=Role::all();
        return response()->json($roles);
    }

    public function update($id, Request $request)
    {
        $table= DB::table('roles')
            ->where('id', $id)
            ->update(['name' => $request->get('name') ,
                    'slug' => $request->get('slug'),
                    'description' => $request->get('description'),

                ]

            );

        return response()->json([
            'message' => 'Rol actualizado correctamente'
        ], 201);    }


    public function borrarRol($idrole){

        $role = Role::find($idrole);
        $role->delete();
        return response()->json([
            'message' => 'Rol eliminado correctamente'
        ], 201);    }


    public function asignarRol($idusu,$idrol){


//        $users = DB::table('users')->select('id')->where('id', '=', $idusu)->first()->id;



        $usuario=User::find($idusu);
        $usuario->assignRoles($idrol);
        $usuario=User::find($idusu);
        return response()->json ([
            'message' => 'Rol Asignado correctamente'
        ], 201);    ;


    }

    public function verRol(){
        //carga el formulario para agregar un nuevo rol
        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.email','roles.name')
            ->get();

        return response()->json($users);
    }

    public function quitarRol($idusu,$idrol){

        $usuario=User::find($idusu);
        $usuario->removeRoles($idrol);
        return response()->json ([
            'message' => 'Rol removido correctamente'
        ], 201);    ;

    }

}
