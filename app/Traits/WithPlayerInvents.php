<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\{UserInv, UserQuest, UserQuestInv};

/**
 * Trait WithPlayerInvents
 *
 * This trait provides methods for managing player inventories, including updating inventory amounts,
 * managing quest inventories, and checking for alternate items. It allows for interactions
 * between user inventories and quests, ensuring the gameplay experience is dynamic and responsive.
 */
trait WithPlayerInvents
{
    /**
     * Update the inventory amount for a given user and inventory item.
     *
     * @param int $currentUserId The ID of the current user.
     * @param int $invId The ID of the inventory item to update.
     * @param int $amount The amount to change (positive to add, negative to subtract). Defaults to -1 (subtract 1).
     * @return mixed The result of the dispatch operation.
     */
	public function UpdateInvent(int $currentUserId, int $invId, int $amount = -1)
	{
		$rawAmount = $amount < 0 ? ' - '.abs($amount) : ' + '.$amount;

		UserInv::updateOrCreate([
            'user_id' => $currentUserId,
            'inv_id' => $invId,
        ],[
            'amount' => DB::raw('users_inventories.amount'.$rawAmount)
        ]);

		return $this->dispatch('swal', 
            title: '<p>success</p>',
            timer: 1000,
            icon: 'success',
            position: 'top-end',
            background: '#334559',
            showConfirmButton: false,
        );
	}

    /**
     * Update the quest inventory for a user, including experience and health adjustments.
     *
     * @param int $currentUserId The ID of the current user.
     * @param int $caseId The ID of the case associated with the quest.
     * @param int $questId The ID of the quest being updated.
     * @param int $invId The ID of the inventory item related to the quest.
     * @param int $coin The amount of coins to update.
     * @param mixed $exp The experience points to update.
     * @param mixed $health The health points to update.
     * @param int $stock The stock amount (default is 0).
     * @return void
     */
	public function UpdateQuestInvent(int $currentUserId, int $caseId, int $questId, int $invId, int $coin, $exp, $health, $stock = 0): void
	{
		UserQuestInv::create([
            'user_id' => $currentUserId,
            'case_id' => $caseId,
            'scenario_id' => $questId,
            'inv_id' => $invId,
            // 'current' => DB::raw('users_quests_invs.current + 1')
            'coin' => $coin,
            'exp' => $exp,
            'health' => $health,
            'stock' => $stock
        ]);

		return;
	}

    /**
     * Check if any alternate items exist for a given case.
     *
     * @param int $caseId The ID of the case to check.
     * @param mixed $alternates An array of alternate inventory IDs.
     * @return bool True if any alternate items exist, false otherwise.
     */
    public function CheckAlternateExists(int $caseId, $alternates): bool
    {
        if(!is_array($alternates)){
            return false;
        }

        $altCount = UserQuestInv::where('case_id', $caseId)
        ->whereIn('inv_id', $alternates)
        ->count();

        return $altCount > 0;
    }

    /**
     * Reduce the inventory attempt count for a given user and quest.
     *
     * @param int $currentUserId The ID of the current user.
     * @param int $questId The ID of the quest being referenced (to be improved).
     * @param string $type The type of attempt to reduce.
     * @return void
     * 
     * IMPORTANT
     * @param $questId is contain risk, TODO: use userQuestId instead
     */
	public function ReduceInventAttempt(int $currentUserId, int $questId, string $type): void
	{
		UserQuest::whereUserId($currentUserId)
            ->whereScenarioId($questId)
            ->whereNull('finished_at')
            ->orderBy('id', 'DESC')
            ->first()
            ->increment($type);

		return;
	}

	
}