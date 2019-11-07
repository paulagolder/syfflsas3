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
     * @ORM\Column(name="update_dt", type="datetime")
     */
    private $update_dt;
    
    /**
     * @ORM\Column(type="string", length=40)
     */
    private $contributor;
    
    /**
     * @ORM\Column(name="registrationcode", type="integer")
     */
    private $registrationcode;
    
    /**
     * @ORM\Column(name="interet", type="string", length = 200)
     */
    private $interet;
    
    /**
     * @ORM\Column(name="membership", type="string", length = 20)
     */
    private $membership;
    
    private $plainPassword;
    private $newregistrationcode;
    public $link;
    
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
     
     public function getInteret()
     {
         return $this->interet;
     }
     
     public function setInteret($text)
     {
         return $this->interet=$text;
     }
     
     public function getMembership()
     {
         return $this->membership;
     }
     
     public function setMembership($text)
     {
         return $this->membership=$text;
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
     
     
     public function setLocale($lang)
     {
         $this->locale = $lang;
     }
     
     public function getLang()
     {
         if( $this->locale == null || $this->locale =="") return "fr";
                   else return $this->locale;
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
     
     public function setLastlogin(?\DateTime $dt): self
     {
         $this->lastlogin = $dt;
         return $this;
     }
     
     public function getUpdate_dt(): ?\DateTime
     {
         return $this->update_dt;
     } 
     
     public function setUpdate_dt(?\DateTime $dt): self
     {
         $this->update_dt = $dt;
         return $this;
     }
     
     public function getContributor()
     {
         return $this->contributor;
     }
     
     
     public function setContributor($text)
     {
         $this->contributor = $text;
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
     
     
     
     public function updateRole($action)
     {
         
     if($action =="emailconfirmed")
     {
        $this->setRegistrationcode(null);
        if($this->membership == "USER")
           $this->rolestr="ROLE_USER";
        elseif($this->membership =="ADMIN" )
           $this->rolestr="ROLE_ADMIN";
        else $this->rolestr="ROLE_AADA";
     }
     
     if($action == "createuser")
     {
         $this->setRegistrationcode( mt_rand(100000, 999999));
         $this->rolestr="ROLE_AEMC";
         $this->membership ="TEMP";
     }
     
     
     if($action=="userapproved")
     {
         $this->setRolestr("ROLE_USER");
        $this->setMembership("USER");
     }
     
     if($action=="userrejected")
     {
         $this->setRolestr("ROLE_DELL");
        $this->setMembership("DELL");
     }
     
     
     if ($action ==  "newpasswordrequest")
     {
         $this->setRegistrationcode( mt_rand(100000, 999999));
        $this->setRolestr("ROLE_APWC;");
     }
     
     if ($action=="passwordchanged")
     {
        $this->setRegistrationcode(null);
        if($this->membership == "USER")
          $this->rolestr="ROLE_USER";
        elseif($this->membership =="ADMIN" )
          $this->rolestr="ROLE_ADMIN";
        else $this->rolestr="ROLE_AADA";
     }
     
     if ($action=="forcereregistration")
     {
         $this->setRegistrationcode( mt_rand(100000, 999999));
         $this->membership = "TEMP";
         $this->rolestr="ROLE_APWC";
     }
     
     if ($action=="reregistration")
     {
         $this->setRegistrationcode(null);
         $this->membership = "TEMP";
         $this->rolestr="ROLE_AADA";
     }
     
     if ($action=="deregistration")
     {
         $this->setRegistrationcode( null);
         $this->membership == "DELL";
         $this->rolestr="ROLE_TEMP";
     }
     
     }
     
     
}

