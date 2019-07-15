<?php
//src/Entity/User.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="fflsasuser")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private $email;

    
    
       /**
     * @ORM\Column(type="string", length=10)
     */
    private $locale;
    
    
         /**
     * @ORM\Column(type="string", length=40)
     */
    private $rolestr;
    
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    
     /**
     * @ORM\Column(name="lastlogin", type="datetime")
     */
    private $lastlogin;
    
    
    
     /**
     * @ORM\Column(name="registrationcode", type="integer")
     */
    private $registrationcode;
    
    
    
    private $plainPassword;
    private $newregistrationcode;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

     public function getUserId()
    {
        return $this->id;
    }
    
     public function getId()
    {
        return $this->id;
    }
    
         public function setId($id)
    {
        $this->id = $id;;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getLabel()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    


    /**
     * @param $salt
     * @return Account
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    
    
    public function getNewregistrationcode()
    {
        return $this->newregistrationcode;
    }

    public function getRoles()
    {
      $roles =explode(";", $this->rolestr);
      foreach($roles as $index => $role)
          $roles[$index] = trim($role);
       return $roles;
    }
    
    public function getRolestr()
    {
       return $this->rolestr;
    }
    
     public function setRolestr($rolestr)
    {
       $this->rolestr = $rolestr;
    }
    
     public function setRoles($roles)
    {
        $this->rolestr="";
        foreach($roles as $index => $role)
        {
          $this->rolestr .= ";".trim($role);
        }
        
    }
    
    
    public function getLocale()
    {
        return $this->locale;
    }
    
     public function getIsactive()
    {
        return $this->isactive;
    }
    
         public function setIsactive($isactive)
    {
        $this->isactive = $isactive;
    }
    
     public function getEmail()
    {
        return $this->email;
    }

      public function setEmail($email)
    {
        $this->email=$email;
    }
    
      public function getLastlogin(): ?\DateTime
   {
     return $this->lastlogin;
   } 
   
   public function setLastlogin(?\DateTime $lastlogin): self
   {
     $this->lastlogin = $lastlogin;
      return $this;
  }

   
    
    
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    
    public function setNewregistrationcode($codeno)
    {
        $this->newregistrationcode = $codeno;
    }
    
     public function setPassword($password)
    {
        $this->password = $password;
    }
    
    
    public function eraseCredentials()
    {
    
     # $this->setPlainPassword(null);
    }
    
      public function getRegistrationcode()
   {
     return $this->registrationcode;
   } 
   
   public function setRegistrationcode($registrationcode)
   {
     $this->registrationcode= $registrationcode;
      return $this;
  }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
           # $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
           # $this->salt,
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
    
    public function codeisvalid()
    {
       if($this->newregistrationcode == $this->registrationcode)  return true;
       else return false;
    }
    
    
    public function hasRole($rstr)
    {
if (strpos($this->getRolestr(), $rstr) !== false) return true;
else return false;   
    }
}

