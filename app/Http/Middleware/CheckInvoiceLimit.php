<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInvoiceLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $userPlan = $user->plan;

        if($userPlan->max_invoice_limit === null)
        {
            return $next($request);
        }

        $userInvoiceCount = $user->invoices()->count();

        if ($userInvoiceCount >= $userPlan->max_invoice_limit) {
            return redirect()
            ->back()
            ->with('error', 'You have reached your Free plan invoice limit (' . $userPlan->max_invoice_limit . ' invoices). Upgrade to the Pro plan to create more invoices.');
        }

        return $next($request);
    }
}
