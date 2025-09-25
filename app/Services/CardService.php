<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Card;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CardService {
    //return card after id
    public function get(int $id): Card {
        $card = Card::query()->findOrFail($id);
        return $card;
    }
    //return user cards
    public function getAll(): Collection{
       $card = Card::query()->get();
       return $card;
    }
    //creates card
    public function create(int $number, int $PIN, string $activate, string $validity, int $balance): bool {
       $cardIsCreated = Card::query()->create([
            "number" => $number,
            "PIN" => $PIN,
            "activate" => $activate,
            "validity" => $validity,
            "balance" => $balance,
            "user_id" => Auth::id()
       ]); 
       return $cardIsCreated?true:false;
    }
    //edit card
    public function update(int $id, int $number, int $PIN, string $activate, string $validity, int $balance): bool {
        $cardIsUpdated = Card::query()->where("id", $id)->where("user_id", Auth::id())->update(["number" => $number, "PIN" => $PIN, "activate" => $activate, "validity" => $validity, "balance" => $balance]);
        return $cardIsUpdated?true:false;
    }
    //delete card
    public function delete(int $id): bool {
        $cardIsDeleted = Card::query()->where("id", $id)->where("user_id", Auth::id())->delete();
        return $cardIsDeleted?true:false;
    }
}