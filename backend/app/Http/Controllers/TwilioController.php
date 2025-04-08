<?php

namespace App\Http\Controllers;

use App\Facades\Twilio;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TwilioController extends Controller
{
    public function makeCall(Contact $contact): JsonResponse
    {
        $call = Twilio::makeCall($contact->phone, $contact->name);

        return response()->json([
            'message' => 'Chamada iniciada!',
            'call_sid' => $call->sid,
        ], JsonResponse::HTTP_OK);
    }

    public function voiceResponse(string $contactName): Response
    {
        return response(
            Twilio::voiceResponse($contactName),
            Response::HTTP_OK
            )
            ->header('Content-Type', 'text/xml');
    }

    public function handleCallStatus(Request $request): JsonResponse
    {
        info("Status da chamada: " . $request->input('CallStatus'));

        return response()->json([], JsonResponse::HTTP_OK);
    }
}
