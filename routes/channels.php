<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('mazad', function ($user) {
    return true;
});

// Broadcast::channel('mazad.{auctionId}', function ($user, $auctionId) {
//     return true; 
// });
