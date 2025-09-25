<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Card;

class CardService {
    //return card after id
    public function get(int $id): Card {
        $card = Card::query()->findOrFail($id);
        return $card;
    }
    //creates card
    public function create(int $number, int $PIN, string $activate, string $validity, int $balance): bool {
       $cardIsCreated = Card::query()->create([
            "number" => $number,
            "PIN" => $PIN,
            "activate" => $activate,
            "validity" => $validity,
            "balance" => $balance
       ]); 
       return $cardIsCreated?true:false;
    }
    //edit card
    public function update(int $id, int $number, int $PIN, string $activate, string $validity, int $balance): bool {
        $cardIsUpdated = Card::query()->where("id", $id)->update(["number" => $number, "PIN" => $PIN, "activate" => $activate, "validity" => $validity, "balance" => $balance]);
        return $cardIsUpdated?true:false;
    }
    //delete card
    public function delete(int $id): bool {
        $cardIsDeleted = Card::query()->where("id", $id)->delete();
        return $cardIsDeleted?true:false;
    }
}