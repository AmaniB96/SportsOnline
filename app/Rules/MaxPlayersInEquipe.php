<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Equipe;

class MaxPlayersInEquipe implements Rule
{
    protected int $max;
    protected ?int $ignorePlayerId;

    public function __construct(int $max = 15, ?int $ignorePlayerId = null)
    {
        $this->max = $max;
        $this->ignorePlayerId = $ignorePlayerId;
    }

    public function passes($attribute, $value): bool
    {
        if (!$value) return true; // equipe nullable allowed
        $equipe = Equipe::find($value);
        if (!$equipe) return false;
        $query = $equipe->joueurs();
        if ($this->ignorePlayerId) $query->where('id', '!=', $this->ignorePlayerId);
        return $query->count() < $this->max;
    }

    public function message(): string
    {
        return "Cette équipe a atteint le nombre maximal de joueurs ({$this->max}).";
    }
}