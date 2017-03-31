Veritas
=========

Identity and Access Control - simplified, but not anemic.

#### WIP: currently experimental only

[![Build Status](https://travis-ci.org/texdc/Veritas.png?branch=develop)](https://travis-ci.org/texdc/Veritas)
[![Coverage Status](https://coveralls.io/repos/texdc/Veritas/badge.png?branch=develop)](https://coveralls.io/r/texdc/Veritas?branch=develop)

Passwords and Validation
------------------------

```php
use texdc\veritas\identity\CryptoServiceInterface;
use texdc\veritas\identity\Password;

class User
{
    /**
     * @var Password
     */
    private $password;
    
    // ...
    
    public function changePassword(string $aPassword, CryptoServiceInterface $aCryptoService)
    {
        $this->setPassword(new Password($aCryptoService->encrypt($aPassword)));
        $this->eventService->publish(new PasswordChangedEvent($this->userId));
    }
    
    protected function setPassword(Password $aPassword)
    {
        if ($this->password == $aPassword) {
            throw new IdenticalPasswordException;
        }
        $this->password = $aPassword;
    }
    
    // ...
}
```
