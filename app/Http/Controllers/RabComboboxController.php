<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Component;
use App\Models\Detail;
use App\Models\Group;
use App\Models\Resource;
use App\Models\Type;
use Illuminate\Http\Request;

class RabComboboxController extends Controller
{
    public function getClassificationsByActivity(Request $request, $activityId)
    {
        $classifications = Classification::where('activity_id', $activityId)->get();
        return response()->json($classifications);
    }

    public function getDetailsByClassification(Request $request, $classificationId)
    {
        $details = Detail::where('classification_id', $classificationId)->get();
        return response()->json($details);
    }

    public function getComponentsByDetail(Request $request, $detailId)
    {
        $components = Component::where('detail_id', $detailId)->get();
        return response()->json($components);
    }

    public function getGroupsByResource(Request $request, $resourceId)
    {
        $groups = Group::where('resource_id', $resourceId)->get();
        return response()->json($groups);
    }

    public function getTypesByGroup(Request $request, $groupId)
    {
        $types = Type::where('group_id', $groupId)->get();
        return response()->json($types);
    }
}
