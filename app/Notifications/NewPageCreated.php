<?php

namespace App\Notifications;

use App\Models\Page;
use Illuminate\Notifications\Notification;

class NewPageCreated extends Notification
{
    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    // Kon channel e pathabe - shudhu database
    public function via($notifiable): array
    {
        return ['database'];
    }

    // Database e ja store hobe
    public function toDatabase($notifiable): array
    {
        return [
            'title'   => 'New Page Created',
            'message' => "A new page \"{$this->page->title}\" has been created.",
            'page_id' => $this->page->id,
            'icon'    => 'file-plus', // frontend icon er jonno
        ];
    }
}
