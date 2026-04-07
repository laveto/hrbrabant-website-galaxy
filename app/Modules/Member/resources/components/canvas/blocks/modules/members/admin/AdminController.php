<?php

namespace App\Modules\Member\Resources\Components\Canvas\Blocks\Modules\Members\Admin;

use App\Modules\Member\Models\Member;
use Galaxy\Core\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class AdminController extends Controller
{
    /**
     * Get unique locations from members
     * 
     * @return Collection
     */
    public function getLocations(): Collection
    {
        $allLocations = Member::query()
            ->whereNotNull('location')
            ->where('location', '!=', '[]')
            ->get(['location'])
            ->flatMap(function ($member) {
                // Extract individual locations from the JSON array
                return $member->location ?: [];
            })
            ->unique()
            ->filter()
            ->map(function ($location) {
                return [
                    'value' => $location,
                    'label' => ucfirst($location), // Capitalize first letter for display
                ];
            })
            ->sortBy('label')
            ->values();

        return $allLocations;
    }
}