<?php

namespace App\Http\Middleware;

use App\Models\Conversation;
use App\Models\Message;
use Closure;

class ShowMessage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $message = new Message();
        if($message->accessMessages($request->id))
        {
            return $next($request);
        }
        return redirect()->route('product.index');
    }
}
