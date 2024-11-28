<?php

namespace App\Providers;

use App\Repositories\AnswerRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\Eloquent\AnswerEloquent;
use App\Repositories\Eloquent\CustomerEloquent;
use App\Repositories\Eloquent\HighlightEloquent;
use App\Repositories\Eloquent\LinkEloquent;
use App\Repositories\Eloquent\MatchEloquent;
use App\Repositories\Eloquent\NotificationEloquent;
use App\Repositories\Eloquent\PackageEloquent;
use App\Repositories\Eloquent\PermissionEloquent;
use App\Repositories\Eloquent\PostEloquent;
use App\Repositories\Eloquent\QuestionEloquent;
use App\Repositories\Eloquent\RoleEloquent;
use App\Repositories\Eloquent\SprintEloquent;
use App\Repositories\Eloquent\TagEloquent;
use App\Repositories\Eloquent\TeamEloquent;
use App\Repositories\Eloquent\TournamentEloquent;
use App\Repositories\Eloquent\TvCategoryEloquent;
use App\Repositories\Eloquent\TvCountryEloquent;
use App\Repositories\Eloquent\TvEloquent;
use App\Repositories\Eloquent\UserEloquent;
use App\Repositories\HighlightRepository;
use App\Repositories\LinkRepository;
use App\Repositories\MatchRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\PackageRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\PostRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SprintRepository;
use App\Repositories\TagRepository;
use App\Repositories\TeamRepository;
use App\Repositories\TourRepository;
use App\Repositories\TvCategoryRepository;
use App\Repositories\TvCountryRepository;
use App\Repositories\TvRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleRepository::class, RoleEloquent::class);
        $this->app->bind(PermissionRepository::class, PermissionEloquent::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
