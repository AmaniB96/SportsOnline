<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class RefuExeption extends Exception
{
    /**
     * Redirige vers la page d'accueil en cas d'exception.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function render(Request $request)
    {
        return redirect()->route('home')->with('error', $this->getMessage() ?: 'Action refusée.');
    }
}
