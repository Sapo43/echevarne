<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission {

    protected $fillable = ['name', 'display_name', 'description', 'grupo'];

    public static function filterAndPaginate($grupo) {
        return Permission::filterGrupo($grupo)
                        ->orderBy('grupo')
                        ->paginate(20);
    }

    public function scopeFilterGrupo($query, $grupo) {
        if (trim($grupo) != "") {
            $query->where('grupo', $grupo);
        }
    }

}
