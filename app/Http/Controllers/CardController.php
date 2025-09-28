<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\IDRequest;
use App\Http\Requests\CardRequest;
use App\Http\Requests\FullCardRequest;
use App\Services\CardService;

class CardController extends Controller
{
    public function __construct(private CardService $cardService) {
    }
    public function index(IDRequest $idRequest): JsonResponse {
        $id = $idRequest->input("id");
        $card = $this->cardService->get($id);
        $number = $card->number;
        $PIN = $card->PIN;
        $activate = $card->activate;
        $validity = $card->validity;
        $balance = $card->balance;
        return response()->json($card);
    }
    public function show(): JsonResponse {
        $cards = $this->cardService->getAll();
        return response()->json($cards);
    }
    public function create(CardRequest $cardRequest): JsonResponse {
        $number = $cardRequest["number"];
        $PIN = $cardRequest["PIN"];
        $activate = $cardRequest["activate"];
        $validity = $cardRequest["validity"];
        $balance = $cardRequest["balance"];
        $message = $this->cardService->create($number, $PIN, $activate, $validity, $balance)?"true":"false";
        return response()->json(["message" => $message]);
    }
    public function update(FullCardRequest $fullCardRequest): JsonResponse {
        $id = $fullCardRequest["id"];
        $number = $fullCardRequest["number"];
        $PIN = $fullCardRequest["PIN"];
        $activate = $fullCardRequest["activate"];
        $validity = $fullCardRequest["validity"];
        $balance = $fullCardRequest["balance"];
        $message = $this->cardService->update($id, $number, $PIN, $activate, $validity, $balance)?"true":"false";
        return response()->json(["message" => $message]);
    }
    public function delete(IDRequest $idRequest): JsonResponse {
        $id = $idRequest["id"];
        $message = $this->cardService->delete($id)?"true":"false";
        return response()->json(["message" => $message]);
    }
}
