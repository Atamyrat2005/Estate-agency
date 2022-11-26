<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer|min:1',
            'ip_address' => 'nullable|string|max:10',
            'device' => 'nullable|string|max:10',
            'platform' => 'nullable|string|max:10',
            'browser' => 'nullable|string|max:10',
            'robot' => 'nullable|string|max:10',
            'is_desktop' => 'nullable|boolean',
            'is_phone' => 'nullable|boolean',
            'is_robot' => 'nullable|boolean',
            'updated_at' => 'nullable|string|max:10',
            'created_at' => 'nullable|string|max:10',
        ]);
        $f_id = $request->id ?: null;
        $f_ipAddress = $request->ip_address ?: null;
        $f_device = $request->device ?: null;
        $f_platform = $request->platform ?: null;
        $f_browser = $request->browser ?: null;
        $f_robot = $request->robot ?: null;
        $f_isDesktop = $request->is_desktop ?: null;
        $f_isPhone = $request->is_phone ?: null;
        $f_isRobot = $request->is_robot ?: null;
        $f_updatedAt = $request->updated_at ?: null;
        $f_createdAt = $request->created_at ?: null;

        $visitors = Visitor::when($f_id, function ($query, $f_id) {
            return $query->where('id', 'like', '%' . $f_id . '%');
        })
            ->when($f_ipAddress, function ($query, $f_ipAddress) {
                return $query->where('ip_address', 'like', '%' . $f_ipAddress . '%');
            })
            ->when($f_device, function ($query, $f_device) {
                return $query->whereHas('userAgent', function ($query2) use ($f_device) {
                    $query2->where('device', 'like', '%' . $f_device . '%');
                });
            })
            ->when($f_platform, function ($query, $f_platform) {
                return $query->whereHas('userAgent', function ($query2) use ($f_platform) {
                    $query2->where('platform', 'like', '%' . $f_platform . '%');
                });
            })
            ->when($f_browser, function ($query, $f_browser) {
                return $query->whereHas('userAgent', function ($query2) use ($f_browser) {
                    $query2->where('browser', 'like', '%' . $f_browser . '%');
                });
            })
            ->when($f_robot, function ($query, $f_robot) {
                return $query->whereHas('userAgent', function ($query2) use ($f_robot) {
                    $query2->where('robot', 'like', '%' . $f_robot . '%');
                });
            })
            ->when(isset($f_isDesktop), function ($query, $f_isDesktop) {
                return $query->whereHas('userAgent', function ($query2) use ($f_isDesktop) {
                    $query2->where('is_desktop', $f_isDesktop);
                });
            })
            ->when(isset($f_isPhone), function ($query, $f_isPhone) {
                return $query->whereHas('userAgent', function ($query2) use ($f_isPhone) {
                    $query2->where('is_phone', $f_isPhone);
                });
            })
            ->when(isset($f_isRobot), function ($query, $f_isRobot) {
                return $query->whereHas('userAgent', function ($query2) use ($f_isRobot) {
                    $query2->where('is_robot', $f_isRobot);
                });
            })
            ->when($f_updatedAt, function ($query, $f_updatedAt) {
                return $query->where('updated_at', 'like', '%' . $f_updatedAt . '%');
            })
            ->when($f_createdAt, function ($query, $f_createdAt) {
                return $query->where('created_at', 'like', '%' . $f_createdAt . '%');
            })
            ->orderBy('updated_at')
            ->orderBy('id')
            ->with(['userAgent'])
            ->paginate(50)
            ->withQueryString();

        return view('Admin.visitor.index', [
            'f_id' => $f_id,
            'f_ipAddress' => $f_ipAddress,
            'f_device' => $f_device,
            'f_platform' => $f_platform,
            'f_browser' => $f_browser,
            'f_robot' => $f_robot,
            'f_isDesktop' => $f_isDesktop,
            'f_isPhone' => $f_isPhone,
            'f_isRobot' => $f_isRobot,
            'f_updatedAt' => $f_updatedAt,
            'f_createdAt' => $f_createdAt,
            'visitors' => $visitors,
        ]);
    }
}
