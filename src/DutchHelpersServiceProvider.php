<?php

namespace ItsOnlyJeff\DutchHelpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class DutchHelpersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'dutch-helpers');
        $this->DutchPhoneNumberRule();
        $this->DutchZipcodeRule();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/dutch-helpers'),
            ], 'translations');
        }
    }

    public function DutchPhoneNumberRule()
    {
        Validator::extend('DutchPhoneNumber', function ($attribute, $phoneNumber) {
            return preg_match('^((\+31)|(0031)|0)(\(0\)|)(\d{1,3})(\s|\-|)(\d{8}|\d{4}\s\d{4}|\d{2}\s\d{2}\s\d{2}\s\d{2})$^', $phoneNumber);
        }, trans('dutch-helpers::validation.phone'));
    }

    public function DutchZipcodeRule()
    {
        Validator::extend('DutchZipcode', function ($attribute, $zipcode) {
            return preg_match('/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i', $zipcode);
        }, trans('dutch-helpers::validation.zipcode'));
    }

}