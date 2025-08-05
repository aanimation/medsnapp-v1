<?php

namespace App\Traits;

use App\Models\{Badge, UserBadge, UserQuestInv, DailyEnergy, DailyCoin};

/**
 * Trait WithBadges
 *
 * This trait provides methods for applying badges to users based on various actions and achievements.
 * It manages badge assignment by updating or creating records in the UserBadge model, 
 * and also tracks inventory and daily log usage for badge eligibility.
 * 
 * NOTES:
 * Observer also manage badge by dirty/changed column value
 */

trait WithBadges
{
	/**
     * Apply a badge to a user based on the badge name.
     *
     * @param int $userId The ID of the user to apply the badge to.
     * @param string $badgeName The name of the badge to be applied.
     * @param string $track Optional tracking information, defaults to 'System'.
     * @return mixed The result of the badge application notification.
     */
	public function ApplyBadge(int $userId, string $badgeName, string $track = 'System')
	{
		$badge = Badge::whereBadgeName($badgeName)->first();

		UserBadge::updateOrCreate([
			'badge_id' => $badge->id,
			'user_id' => $userId,
		],[
			'track_his' => $track,
		]);

		return $this->__applyBadge($badgeName);
	}

	/**
	 * Implemented for investigation & treatment
	 * 
	 * 
     * Apply a badge to a user based on a specific category of usage.
     *
     * @param int $userId The ID of the user to apply the badge to.
     * @param string $category The category for which the badge is being applied.
     * @return void
     */
	public function ApplyBadgePerCategory(int $userId, string $category)
	{
		// tracking the inventory usage
		$userQuestInvLogCount = UserQuestInv::whereUserId($userId)
			->whereHas('Inventory', function($query) use($category){
				$query->where('type', $category);
			})->count();

		// find the badge by requirement value
		$badge = Badge::where([
			'category' => $category,
			'requirement' => $userQuestInvLogCount + 1,
		])->first();

		if($badge){
			UserBadge::updateOrCreate([
				'badge_id' => $badge->id,
				'user_id' => $userId,
			],[
				'track_his' => $category,
			]);

			return $this->__applyBadge($badge->badge_name);
		}

		return;
	}

	/**
	 * Implemented for bonus: streak and coins as category
	 * 
     * Apply a badge to a user based on bonus actions like streaks and coin collection.
     *
     * @param int $userId The ID of the user to apply the badge to.
     * @param string $category The category for which the badge is being applied, defaults to 'streak'.
     * @return void
     */
	public function ApplyBadgePerBonus(int $userId, string $category = 'streak')
	{
		// tracking the daily
		if($category === 'coins'){
			$userDailyLogCount = DailyCoin::whereUserId($userId)->sum('coin');
		}else{
			$userDailyLogCount = DailyEnergy::whereUserId($userId)->count();
		}

		// find the badge by requirement value
		$badge = Badge::where([
			'category' => $category,
			'requirement' => $userDailyLogCount + 1,
		])->first();

		if($badge){
			if(UserBadge::whereUserId($userId)->whereBadgeId($badge->id)->count() == 0){

				UserBadge::create([
					'badge_id' => $badge->id,
					'user_id' => $userId,
					'track_his' => $category,
				]);

				return $this->__applyBadge($badge->badge_name);
				
			}
		}

		return;
	}

	/**
     * Dispatch a notification to the user about the applied badge.
     *
     * @param string $badgeName The name of the badge that was applied.
     * @return mixed The result of the badge notification.
     */
	function __applyBadge($badgeName)
	{
		$badgeImage = str_replace(' ', '-', $badgeName);

		if($badgeName === 'Level 1') {
			return $this->dispatch('swal', 
				title: '<h3>Congratulations!</h3><p>You just gained the first badge<br><strong>'.$badgeName.'</strong></p>',
				imageUrl: '/assets/badges/'.$badgeImage.'.png',
				imageWidth: 80,
				imageHeight: 80,
				imageAlt: "badge",
				showConfirmButton: false,
				showCloseButton: true,
				position: 'center',
				background: '#334559',
			);
		}
		
		return $this->dispatch('swal', 
			title: '<p>You earned the following badge <strong>'.$badgeName.'</strong></p>',
			imageUrl: '/assets/badges/'.$badgeImage.'.png',
			imageWidth: 80,
			imageHeight: 80,
			imageAlt: "badge",
			showConfirmButton: false,
			showCloseButton: true,
			position: 'center',
			background: '#334559',
		);
	}
	
}