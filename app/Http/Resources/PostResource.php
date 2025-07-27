<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'image' => $this->image ? asset($this->image) : null,
            'created_at' => $this->created_at,
        ];
        $user = $request->user();
        $role = match (get_class($user)) {
            \App\Models\Admin::class => 'admin',
            \App\Models\User::class => 'user',
        };
        if ($role === 'admin') {
            $data['user'] = $this->admin ?? $this->user;
        }
        return $data;
    }
}
