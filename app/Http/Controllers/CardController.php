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
    //get card after id
    public function index(IDRequest $idRequest): JsonResponse {
        $id = $idRequest->input("id");
        $card = $this->cardService->get($id); 
        return response()->json($card);
    }
    //show all cards
    public function show(): JsonResponse {
        $cards = $this->cardService->getAll();
        return response()->json($cards);
    }
    //create card
    public function create(CardRequest $cardRequest): JsonResponse {
        $number = $cardRequest["number"];
        $PIN = $cardRequest["PIN"];
        $activate = $cardRequest["activate"];
        $validity = $cardRequest["validity"];
        $balance = $cardRequest["balance"];
        $message = $this->cardService->create($number, $PIN, $activate, $validity, $balance)?"Card has sucessfully created":"";
        return response()->json(["message" => $message]);
    }
    //update card
    public function update(FullCardRequest $fullCardRequest): JsonResponse {
        $id = $fullCardRequest["id"];
        $number = $fullCardRequest["number"];
        $PIN = $fullCardRequest["PIN"];
        $activate = $fullCardRequest["activate"];
        $validity = $fullCardRequest["validity"];
        $balance = $fullCardRequest["balance"];
        $message = $this->cardService->update($id, $number, $PIN, $activate, $validity, $balance)?"Card has sucessfully updated":"";
        return response()->json(["message" => $message]);
    }
    //delete card
    public function delete(IDRequest $idRequest): JsonResponse {
        $id = $idRequest["id"];
        $message = $this->cardService->delete($id)?"Card has sucessfully deleted":"";
        return response()->json(["message" => $message]);
    }
}
