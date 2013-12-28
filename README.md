Veritas
=========

Identity and Access Control - simplified, but not anemic.

[![Build Status](https://travis-ci.org/texdc/Veritas.png?branch=master)](https://travis-ci.org/texdc/Veritas)

Passwords and Validation
------------------------

```php
use Veritas\Identity\CryptoService;
use Veritas\Identity\Password;

class User
{
    /**
     * @var Password
     */
    private $password;
    
    // ...
    
    public function password()
    {
        return $this->password;
    }
    
    public function changePassword($newPassword, CryptoService $cryptoService = null)
    {
        $cryptoService = $cryptoService ?: $this->password->cryptoService();
        $oldPassword   = $this->password;
        
        $this->setPassword(new Password($newPassword, $cryptoService));
        
        $this->eventService->publish(
            new PasswordChangedEvent($oldPassword, $this->password)
        );
    }
    
    public function verifyPassword(Password $password)
    {
        return $this->password->equals($password);
    }
    
    public function verifyTextPassword($textPassword)
    {
        return $this->password->verify($textPassword);
    }
    
    protected function setPassword(Password $password)
    {
        $this->password = $password;
    }
    
    // ...
}
```
