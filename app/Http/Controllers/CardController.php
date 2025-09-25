<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\IDRequest;
use App\Http\Requests\CardRequest;
use App\Services\CardService;
use Illuminate\View\View;

class CardController extends Controller
{
    public function __construct(private CardService $cardService) {
        $this->cardService = $cardService;
    }
    public function index(IDRequest $idRequest): View {
        $id = $idRequest->input("id");
        $card = $this->cardService->get($id);
        $number = $card->number;
        $PIN = $card->PIN;
        $activate = $card->activate;
        $validity = $card->validity;
        $balance = $card->balance;
        return view("index", ["number" => $number, "PIN" => $PIN, "activate" => $activate, "validity" => $validity, "balance" => $balance]);
    }
    public function show(): View {
        $cards = $this->cardService->getAll();
        return view("index", ["cards" => $cards]);
    }
    public function create(CardRequest $cardRequest): RedirectResponse {
        $number = $cardRequest["number"];
        $PIN = $cardRequest["PIN"];
        $activate = $cardRequest["activate"];
        $validity = $cardRequest["validity"];
        $balance = $cardRequest["balance"];
        $message = $this->cardService->create($number, $PIN, $activate, $validity, $balance)?"true":"false";
        return redirect()->route("index", ["message" => $message]);
    }
    public function update(IDRequest $idRequest, CardRequest $cardRequest): RedirectResponse {
        $id = $cardRequest["id"];
        $number = $cardRequest["number"];
        $PIN = $cardRequest["PIN"];
        $activate = $cardRequest["activate"];
        $validity = $cardRequest["validity"];
        $balance = $cardRequest["balance"];
        $message = $this->cardService->update($id, $number, $PIN, $activate, $validity, $balance)?"true":"false";
        return redirect()->route("index", ["message" => $message]);
    }
    public function delete(IDRequest $idRequest): RedirectResponse {
        $id = $idRequest["id"];
        $message = $this->cardService->delete($id)?"true":"false";
        return redirect()->route("index", ["message" => $message]);
    }
}
