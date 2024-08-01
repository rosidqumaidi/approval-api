<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ApprovalRepositoryInterface;
use App\Repositories\ExpenseRepositoryInterface;
use App\Repositories\ApprovalRepository;
use App\Repositories\ApprovalStageRepository;
use App\Repositories\ApprovalStageRepositoryInterface;
use App\Repositories\ApproverRepository;
use App\Repositories\ApproverRepositoryInterface;
use App\Repositories\ExpenseRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ApproverRepositoryInterface::class, ApproverRepository::class);
        $this->app->bind(ApprovalStageRepositoryInterface::class, ApprovalStageRepository::class);
        $this->app->bind(ApprovalRepositoryInterface::class, ApprovalRepository::class);
        $this->app->bind(ExpenseRepositoryInterface::class, ExpenseRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
