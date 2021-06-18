<?php

namespace App\Http\Traits;

trait AuditTrait {

    public function setAudit($guard) {

        $AuthUserId = \Auth::guard($guard)->user()->id;
        
        if (isset($this->id)) {
            $this->setUpdatedBy($AuthUserId);
        }else{
            $this->setCreatedBy($AuthUserId);
        }

    }

    public function setCreatedBy($value) {
        $this->created_by = $value;
    }

    public function setUpdatedBy($value) {
        $this->updated_by = $value;
    }

}
