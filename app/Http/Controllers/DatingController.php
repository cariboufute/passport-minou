<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

class DatingController extends Controller
{
    public function sex()
    {
        return Gate::allows('have-sex') ?
            'Viens-t\'en mon beau!' :
            'Dégage, le lette!';
    }

    public function love()
    {
        return Gate::allows('have-heart') ?
            'Oh oui mon amour!' :
            'Je ne donne mon cœur qu\'à mon mari.';
    }
}
