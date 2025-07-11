<?php

if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
    return redirect()->to('/auth/login');
}
