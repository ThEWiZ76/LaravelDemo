<?php

namespace App\Support;

use PragmaRX\Google2FALaravel\Exceptions\InvalidSecretKey;
use PragmaRX\Google2FALaravel\Support\Authenticator;

/**
 * Created by PhpStorm.
 * User: Roland
 * Date: 13-11-2018
 * Time: 16:22
 */

class Google2FAAuthentication extends Authenticator{

    protected function canPassWithoutChecking(){
        if (!count($this->getUser()->passwordSecurity)){
            return true;
        }
        return !$this->getUser()->passwordSecurity->google2fa_enable || !$this->enabled() || $this->noUserIsAuthenticated() || $this->twoFactorAuthStillValid();

    }

    protected function getGoogle2FaSecretkey(){
        $secret =$this->getUser()->passwordSecurity->{$this->config('otp_secret_column')};

        if (is_null($secret) || empty($secret)){
            throw new InvalidSecretKey('Secret key cannot be empty');
        }
        return $secret;
    }
}