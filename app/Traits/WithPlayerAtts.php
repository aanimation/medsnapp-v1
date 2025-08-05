<?php

namespace App\Traits;

use App\Models\{User, UserAtts, UserQuest};

/**
 * Trait WithPlayerAtts
 *
 * This trait provides methods for managing player attributes, including level, experience points,
 * and other properties. It allows for modifying user attributes based on game mechanics,
 * ensuring a smooth progression system.
 */
trait WithPlayerAtts
{
	/**
     * Change the specified attribute value for a user's quest.
     *
     * @param UserQuest $userQuest The UserQuest instance related to the user.
     * @param string $property The property to change (options: 'reputation', 'level', 'rank').
     * @param int $value The value to add to the current property value.
     * @return void
     */
	public function ChangeLevelValue(UserQuest $userQuest, string $property, int $value): void
	{
		/* prop options : reputation, level, rank */

		$user = $userQuest->User;
		if(is_null($userQuest->{$property})){ // fresh detected
			$user->increment($property, $value);
			$userQuest->update([$property => $value]); // final update
		}

		return;
	}

	/**
     * Add a specified value to a user's attribute.
     *
     * @param User $currentUser The user whose attribute will be modified.
     * @param string $property The attribute to modify (e.g., 'exps', 'coins').
     * @param int $value The value to add to the current attribute value.
     * @return void
     */
	public function AddPropValue(User $currentUser, string $property, int $value): void
	{
		$propValue = $currentUser->Atts->{$property};
		$propMaxValue = $currentUser->Atts["max_{$property}"];

		if(($propValue + $value) >= $propMaxValue){
			if($property === 'exps'){
				$currentUser->Atts->update(["max_{$property}" => $this->getNextMaxExp($currentUser->level)]);
			}elseif($property === 'coins'){
				if($value > 0) {
					$currentUser->Atts->update(["max_{$property}" => $propMaxValue+(100*$currentUser->level)]);
				}
			}else{
				$value = $propMaxValue - $propValue;	
			}
			
		}

		if(($propValue + $value) < 0){
			$value = $propValue;
		}

		$currentUser->Atts->increment($property, $value);
		if($property === 'exps' && $this->incrementLevel($currentUser->Atts->{$property}, intval($currentUser->level))) {
			$currentUser->increment('level', 1);
		}

		if($value < 0){
			$this->countDown($propValue, ($propValue + $value), $property.'Counter');
		}else{
			$this->countUp($propValue, ($propValue + $value), $property.'Counter');
		}

		return;
	}

	/**
     * Check if the user has enough of a specified attribute.
     *
     * @param User $currentUser The user to check.
     * @param string $property The attribute to check (e.g., 'coins').
     * @param int $value The required value.
     * @return bool True if the user has enough of the attribute, false otherwise.
     */
	public function HasStock(User $currentUser, string $property, int $value): bool
	{
		return $currentUser->Atts->{$property} >= $value;
	}
	

	/**
	 * HELPERS
	*/

	/**
     * Countdown from a start value to a finish value, updating a target.
     *
     * @param int $start The starting value for the countdown.
     * @param int $finish The finish value for the countdown.
     * @param string $target The target to stream the countdown to.
     * @param int $sleep The sleep duration in microseconds between updates, defaults to 25000 (25ms).
     * @return void
     */
	function countDown($start, $finish, $target, $sleep = 25000)
	{
		while ($start > $finish) {
			$this->stream(to: $target, content: $start, replace: true,);
			usleep( $sleep );
			$start--;
		};
	}

	/**
     * Count up from a start value to a finish value, updating a target.
     *
     * @param int $start The starting value for the count up.
     * @param int $finish The finish value for the count up.
     * @param string $target The target to stream the count up to.
     * @param int $sleep The sleep duration in microseconds between updates, defaults to 25000 (25ms).
     * @return void
     */
	function countUp($start, $finish, $target, $sleep = 25000)
	{
		while ($start < $finish) {
			$this->stream(to: $target, content: $start, replace: true,);
			usleep( $sleep );
			$start++;
		};
	}

	/**
     * Check if the current experience points qualify for a level increment.
     *
     * @param int $currentExp The current experience points.
     * @param int $currentLevel The current level of the user.
     * @return bool True if the user can level up, false otherwise.
     */
	function incrementLevel(int $currentExp, int $currentLevel)
	{
		$levels = [1 => 100, 2 => 200, 3 => 300, 4 => 400, 5 => 500, 6 => 700, 7 => 900, 8 => 1100, 9 => 1300, 10 => 1500, 11 => 1800, 12 => 2100, 13 => 2400, 14 => 2700, 15 => 3000, 16 => 3500, 17 => 4000, 18 => 4500, 19 => 5000, 20 => 6000];

		return $currentExp >= $levels[$currentLevel];
	}

	/**
     * Get the maximum experience points required for the next level.
     *
     * @param int $currentLevel The current level of the user.
     * @return int The maximum experience points for the next level.
     */
	function getNextMaxExp(int $currentLevel)
	{
		$levels = [1 => 100, 2 => 200, 3 => 300, 4 => 400, 5 => 500, 6 => 700, 7 => 900, 8 => 1100, 9 => 1300, 10 => 1500, 11 => 1800, 12 => 2100, 13 => 2400, 14 => 2700, 15 => 3000, 16 => 3500, 17 => 4000, 18 => 4500, 19 => 5000, 20 => 6000];

		return $levels[$currentLevel];
	}
}



/*

NOTES

To create a sense of progression and achievement in MedSnapp, assigning experience points (XP) to different levels can be very effective. Here's a sample structure with XP values for different levels:

### XP System for Game Levels

#### Beginner Levels (1-5)
1. **Level 1: 100 XP**
   - Introduction to basic medical terms and concepts.
   - Simple quizzes and matching games.
   
2. **Level 2: 200 XP**
   - Introduction to anatomy.
   - Labeling diagrams and flashcards.

3. **Level 3: 300 XP**
   - Basic physiology concepts.
   - Short-answer quizzes and interactive activities.

4. **Level 4: 400 XP**
   - Introduction to common medical procedures.
   - Mini-games simulating basic procedures.

5. **Level 5: 500 XP**
   - Basic patient assessment techniques.
   - Case studies and scenario-based quizzes.

#### Intermediate Levels (6-10)
6. **Level 6: 700 XP**
   - Intermediate anatomy and physiology.
   - Interactive simulations and detailed quizzes.

7. **Level 7: 900 XP**
   - Pathophysiology basics.
   - Problem-solving scenarios and applied knowledge quizzes.

8. **Level 8: 1100 XP**
   - Diagnostic techniques and tools.
   - Diagnostic games and case studies.

9. **Level 9: 1300 XP**
   - Treatment plans and pharmacology basics.
   - Interactive treatment planning and medication quizzes.

10. **Level 10: 1500 XP**
    - Emergency procedures and critical care basics.
    - High-intensity simulations and advanced case studies.

#### Advanced Levels (11-15)
11. **Level 11: 1800 XP**
    - Specialized medical fields introduction.
    - Specialized quizzes and targeted scenarios.

12. **Level 12: 2100 XP**
    - Advanced diagnostics and treatment.
    - Complex simulations and diagnostic challenges.

13. **Level 13: 2400 XP**
    - Research and evidence-based medicine.
    - Research interpretation and application activities.

14. **Level 14: 2700 XP**
    - Advanced patient care techniques.
    - Multi-step patient care simulations.

15. **Level 15: 3000 XP**
    - Integrative medicine and holistic approaches.
    - Comprehensive case studies and integrative care plans.

### Expert Levels (16-20)
16. **Level 16: 3500 XP**
    - Advanced specialties (e.g., cardiology, neurology).
    - Specialty-focused simulations and in-depth quizzes.

17. **Level 17: 4000 XP**
    - Cutting-edge medical technologies.
    - Technology integration simulations and futuristic scenarios.

18. **Level 18: 4500 XP**
    - Leadership and healthcare management.
    - Management challenges and leadership role-play.

19. **Level 19: 5000 XP**
    - Teaching and mentorship in medicine.
    - Mentor-based simulations and teaching challenges.

20. **Level 20: 6000 XP**
    - Mastery of comprehensive medical knowledge.
    - Ultimate medical challenges and mastery-level scenarios.

### Summary

**Beginner Levels (1-5)**: 100 XP to 500 XP
**Intermediate Levels (6-10)**: 700 XP to 1500 XP
**Advanced Levels (11-15)**: 1800 XP to 3000 XP
**Expert Levels (16-20)**: 3500 XP to 6000 XP

This structure ensures that the XP requirements increase progressively, keeping users motivated and challenged as they advance. Adjust these values as needed based on user feedback and engagement metrics to maintain a balanced and rewarding experience.

*/