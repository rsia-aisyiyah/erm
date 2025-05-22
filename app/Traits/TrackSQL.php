<?php

namespace App\Traits;

trait TrackSQL
{
    public function trackSQL($query)
    {
        // // render eloquent to sql
        

        // $this->sql = $query->toSql();
        // $this->bindings = $query->getBindings();



        $this->sql = str_replace('?', '%s', $query->toSql());
        $this->bindings = $query->getBindings();
        $this->sql = vsprintf($this->sql, $this->bindings);
    }
}