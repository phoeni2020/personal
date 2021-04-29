<?php
namespace App\Traits;

use App\Models\Error;

trait ErrorhandlerTrait
{
    public function Errorhandle(\Exception $e){
        $error = Error::create([
            'status_code' => json_encode($e->getCode()),
            'user' => auth()->id(),
            'massage' => json_encode($e->getMessage()),
            'file' => json_encode($e->getFile()),
            'trace' => json_encode($e->getTrace()),
            'trace_as_string' => json_encode($e->getTraceAsString()),
            'line' => json_encode($e->getLine()),
            'previous' => json_encode($e->getPrevious())
        ]);
        return $error;
    }
}
