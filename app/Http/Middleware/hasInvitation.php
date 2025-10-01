<?php

namespace App\Http\Middleware;

use App\Models\Invitation;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class hasInvitation
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Only for GET requests. Otherwise, this middleware will block our registration.
         */
        if ($request->isMethod('get')) {
            /**
             * No token = Good bye.
             */
            if (! $request->has('invitation_token')) {
                flash()->error('Oops something is wrong.');

                return redirect(route('home'));
            }

            $invitation_token = $request->get('invitation_token');

            /**
             * Lets try to find invitation by its token.
             * If failed -> return to request page with error.
             */
            try {
                $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                flash()->error('Wrong invitation token! Please check your URL.');

                return redirect(route('home'));
            }

            // Check if user already registered using this invitation
            /**
             * Lets check if users already registered.
             * If yes -> redirect to login with error.
             */
            if (! is_null($invitation->registered_at)) {
                flash()->error('The invitation link has already been used.');

                return redirect(route('login'));
            }
        }

        return $next($request);
    }
}
