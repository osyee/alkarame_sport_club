<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sports;
use Ramsey\Uuid\Uuid;

class SportsController extends Controller
{
    public function store()
    {
    $port=new Sports();
    $port->uuid=Uuid::uuid4();
    $port->name='adtxcdfss';
    $port->image='ta';
    $port->save();

    }
}
