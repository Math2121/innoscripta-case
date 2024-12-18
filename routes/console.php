<?php

use App\Jobs\FetchNewArticles;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;


Schedule::job(new FetchNewArticles)->everyTwoSeconds();
