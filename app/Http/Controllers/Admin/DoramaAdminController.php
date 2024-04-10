<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Dorama;
use App\Reina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DoramaAdminController extends Controller
{

    public function index(): View
    {
        $doramas = Dorama::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id'])
            ->with('type')
            ->with('country')
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.index')->with('doramas', $doramas);
    }

    public function draft(): View
    {
        $doramas = Dorama::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::DRAFT)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.index')->with('doramas', $doramas);
    }

    public function published(): View
    {
        $doramas = Dorama::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::PUBLISHED)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.index')->with('doramas', $doramas);
    }

    public function archive(): View
    {
        $doramas = Dorama::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::ARCHIVE)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.index')->with('doramas', $doramas);
    }
}
