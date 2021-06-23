<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    const ESTADO_HABILITADO = "H";
    const ESTADO_INHABILITADO = "I";
    use HasFactory, Notifiable;
    //use AuditTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'username', 'nombre', 'apellido', 'email', 'dni', 'telefono', 'password', 'estado', 'cuit', 'operatoria', 'nro_cliente','porcentaje_venta','porcentaje_compra'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public static function filterAndPaginate($estado, $apellido, $dni, $email, $nroCliente, $cuit) {
        return User::estado($estado)
                        ->apellido($apellido)
                        ->dni($dni)
                        ->email($email)
                        ->nroCliente($nroCliente)
                        ->cuit($cuit)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
    }

    public function scopeEstado($query, $estado) {
        if (trim($estado) != "") {
            $query->where('estado', $estado);
        }
    }

    public function scopeApellido($query, $apellido) {
        if (trim($apellido) != "") {
            $query->where('apellido', 'like', '%' . $apellido . '%');
        }
    }

    public function scopeDni($query, $dni) {
        if (trim($dni) != "") {
            $query->where('dni', StrHelper::soloNumeros(trim($dni)));
        }
    }

    public function scopeCuit($query, $cuit) {
        if (trim($cuit) != "") {
            $query->where('cuit', StrHelper::soloNumeros(trim($cuit)));
        }
    }

    public function scopeNroCliente($query, $nro_cliente) {
        if (trim($nro_cliente) != "") {
            $query->where('nro_cliente', $nro_cliente);
        }
    }

    public function scopeEmail($query, $email) {
        if (trim($email) != "") {
            $query->where('email', $email);
        }
    }

    public static function getEstadoHabilitado() {
        return self::ESTADO_HABILITADO;
    }

    public static function getEstadoInhabilitado() {
        return self::ESTADO_INHABILITADO;
    }

    public static function getComboEstados() {
        return [
            self::getEstadoHabilitado() => self::getEstadoHabilitado(),
            self::getEstadoInhabilitado() => self::getEstadoInhabilitado()
        ];
    }

    public function getCreatedAtAttribute($date) {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($date) {
        if ($date !== '0000-00-00 00:00:00' && !is_null($date)) {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
        } else {
            return null;
        }
    }

}
