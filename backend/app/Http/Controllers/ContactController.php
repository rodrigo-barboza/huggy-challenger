<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\StoreContactAction;
use App\Actions\UpdateContactAction;
use App\Dtos\ContactDto;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ContactController
{
    public function index(): AnonymousResourceCollection
    {
        return ContactResource::collection(Contact::query()->paginate(20));
    }

    public function store(ContactStoreRequest $request, StoreContactAction $action): JsonResponse
    {
        $action->handle(new ContactDto(...$request->validated()));

        return response()->json([
            'message' => 'Contato criado com sucesso',
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(
        ContactUpdateRequest $request,
        Contact $contact,
        UpdateContactAction $action,
    ): JsonResponse {
        $action->handle(new ContactDto(...$request->validated()), $contact);

        return response()->json([
            'message' => 'Contato atualizado com sucesso',
        ], JsonResponse::HTTP_OK);
    }

    public function destroy(Contact $contact)
    {
        //
    }
}
