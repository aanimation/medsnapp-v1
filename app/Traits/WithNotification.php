<?php

namespace App\Traits;

use App\Models\{Notification as NotifModel, UserNotif};

trait WithNotification
{
    public function addPaymentNotification($userId, $transCode)
    {
        return $this->addNotification([
            'title' => 'Payment Paid',
            'description' => "Great, billing with code {$transCode} successfully paid",
            'type' => 'User',
            'route' => 'player-bills',
            // 'url' => null,
        ], $userId);
    }

    public function addUpgradeNotification($userId)
    {
        return $this->addNotification([
            'title' => 'Upgrade Plan',
            'description' => 'Your upgrade has been requested',
            'type' => 'User',
            'route' => 'player-bills',
            // 'url' => null,
        ], $userId);
    }

    public function addCoinNotification($userId, $size = 1)
    {
        return $this->addNotification([
            'title' => 'Coin Updated',
            'description' => $size . ' coins has received',
            'type' => 'Coin',
            // 'route' => null,
            // 'url' => null,
        ], $userId);
    }

    public function addEnergyNotification($userId, $size = 1)
    {
        return $this->addNotification([
            'title' => 'Energy Updated',
            'description' => $size . ' energy has received',
            'type' => 'Energy',
            // 'route' => null,
            // 'url' => null,
        ], $userId);
    }

    public function addAdminNotification(array $data, $userId)
    {
        return $this->addNotification([
            'title' => $data['title'],
            'description' => $data['description'],
            'type' => 'Admin',
            'route' => 'player-dashboard',
            // 'url' => null,
        ], $userId);
    }

	protected function addNotification(array $data, $userId)
	{
        $userId = $userId ?? auth()->id();

        $item = NotifModel::updateOrCreate($data,[
            'title' => $data['title']
        ]);

        $item = $item->fresh();

        $this->setUserNotif($item->id, $userId);

		return;
	}

    protected function setUserNotif($notificationId, $userId)
    {
        UserNotif::create([
            'user_id' => $userId,
            'notification_id' => $notificationId,
            'is_read' => false
        ]);

        return;
    }

    public function markAsRead($userNotifId)
    {
        return UserNotif::find($userNotifId)->updateQuietly(['is_read' => true]);
    }
}