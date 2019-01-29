<?php

namespace App\Providers;

use App\Models\Institute;
use App\Repository\Eloquent\CandidateEloquent;
use App\Repository\Eloquent\PositionEloquent;
use App\Repository\Eloquent\ElectionEloquent;
use App\Repository\Eloquent\InstituteEloquent;
use App\Repository\Eloquent\StandardEloquent;
use App\Repository\Eloquent\UserEloquent;
use App\Repository\Eloquent\VoterEloquent;
use App\Repository\Interfaces\IPositionRepository;
use App\Repository\Interfaces\ICandidateRepository;
use App\Repository\Interfaces\IElectionRepository;
use App\Repository\Interfaces\IInstituteRepository;
use App\Repository\Interfaces\IStandardRepository;
use App\Repository\Interfaces\IUserRepository;
use App\Repository\Interfaces\IVoterRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserEloquent::class);
        $this->app->bind(ICandidateRepository::class, CandidateEloquent::class);
        $this->app->bind(IPositionRepository::class, PositionEloquent::class);
        $this->app->bind(IVoterRepository::class, VoterEloquent::class);
        $this->app->bind(IElectionRepository::class, ElectionEloquent::class);
        $this->app->bind(IInstituteRepository::class, InstituteEloquent::class);
        $this->app->bind(IStandardRepository::class, StandardEloquent::class);
    }
}
