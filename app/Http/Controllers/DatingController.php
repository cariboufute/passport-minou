<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DatingController extends Controller
{
    public function sex()
    {
        return Gate::allows('is-self') ?
            'On n\'est jamais mieux servi que par soi-même!' :
            $this->sexWithAnother();
    }

    protected function sexWithAnother()
    {
        return Gate::allows('have-sex') ?
            'Viens-t\'en mon beau!' :
            'Dégage, le lette!';
    }

    public function love()
    {
        return Gate::allows('is-self') ?
            'C\'est beau l\'amour de soi...' :
            $this->loveWithAnother();
    }

    protected function loveWithAnother()
    {
        return Gate::allows('have-love') ?
            'Oh oui mon amour!' :
            'Je ne donne mon cœur qu\'à mon mari.';
    }
}
