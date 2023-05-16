<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WebController extends BaseController
{
    /**
     * Путь к вьюшке
     */
    public const VIEW_PATH = 'plots.';

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view(self::VIEW_PATH . 'index');
    }
}
