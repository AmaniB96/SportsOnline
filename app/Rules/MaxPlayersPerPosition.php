<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Equipe;

class MaxPlayersPerPosition implements Rule
{
    protected int $maxPerPosition;
    protected ?int $positionId;
    protected ?int $ignorePlayerId;

    public function __construct(int $maxPerPosition = 4, ?int $positionId = null, ?int $ignorePlayerId = null)
    {
        $this->maxPerPosition = $maxPerPosition;
        $this->positionId = $positionId;
        $this->ignorePlayerId = $ignorePlayerId;
    }

    public function passes($attribute, $value): bool
    {
        if (!$value || !$this->positionId) return true;
        $equipe = Equipe::find($value);
        if (!$equipe) return false;
        $query = $equipe->joueurs()->where('position_id', $this->positionId);
        if ($this->ignorePlayerId) $query->where('id', '!=', $this->ignorePlayerId);
        return $query->count() < $this->maxPerPosition;
    }

    public function message(): string
    {
        return "Il y a déjà {$this->maxPerPosition} joueurs à ce poste dans l'équipe.";
    }
}