<?php namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
//use Illuminate\Users\Repository as UserRepository;

class ProfileComposer {

//    /**
//     * The user repository implementation.
//     *
//     * @var UserRepository
//     */
//    protected $users;
//
//    /**
//     * Create a new profile composer.
//     *
//     * @param  UserRepository  $users
//     * @return void
//     */
//    public function __construct(UserRepository $users)
//    {
//        // Зависимости разрешаются автоматически службой контейнера...
//        $this->users = $users;
//    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function create(View $view)
    {
        $view->with('count', 99999);
//        $view->with('count', $this->users->count());
    }

}