<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\StoreContactAction;
use App\Dtos\ContactDto;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

final class GetLeadsFromHuggyFlowController
{
    public function __invoke(StoreContactAction $action): Response
    {
        try {
            $action->handle(new ContactDto(
                ...request()->only([
                        'name',
                        'email',
                        'phone',
                        'cellphone',
                        'address',
                        'neighborhood',
                        'state',
                        'city',
                    ]
                )
            ));
        } catch (\Exception $e) {
            Log::channel('huggy-flow')->error($e->getMessage());
        }

        return response([], 200);
    }
}
