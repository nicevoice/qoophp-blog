<?php
namespace Library\Auth;

use Models\Administrator;
use Phalcon\Exception;
use Phalcon\Mvc\User\Component;

/**
 * Vokuro\Auth\Auth
 * Manages Authentication/Identity Management in Vokuro
 */
class Auth extends Component
{
    public function check($credentials)
    {
        $user = Administrator::findFirstByUsername($credentials['username']);
        if ($user == false) {
            return false;
        }

        if(!$user->comparePassword($credentials['password'])){
            return false;
        }

        $user->updateLoginInfo();

        $this->session->set('auth', array(
            'id' => $user->id,
            'name' => $user->username,
            'nick' => $user->nickname
        ));
        return true;
    }

    public function refreshSessionData($data)
    {
        $auth_data = $this->session->get('auth');
        $auth_data['nick'] = $data->nickname;
        $this->session->set('auth', $auth_data);
    }

    public function getIdentity()
    {
        return $this->session->get('auth');
    }

    public function isGuest()
    {
        $auth = $this->session->get('auth');
        return empty($auth);
    }

    /**
     * Returns the current identity
     *
     * @return string
     */
    public function getName()
    {
        $identity = $this->session->get('auth');
        return $identity['name'];
    }

    public function getId()
    {
        $identity = $this->session->get('auth');
        return $identity['id'];
    }

    public function getNick()
    {
        $identity = $this->session->get('auth');
        return $identity['nick'];
    }

    /**
     * Removes the user identity information from session
     */
    public function remove()
    {
        if ($this->cookies->has('RMU')) {
            $this->cookies->get('RMU')->delete();
        }
        if ($this->cookies->has('RMT')) {
            $this->cookies->get('RMT')->delete();
        }

        $this->session->remove('auth');
    }

    public function getUser()
    {
        $identity = $this->session->get('auth');
        if (isset($identity['id'])) {

            $user = Administrator::findFirstById($identity['id']);
            if ($user == false) {
                throw new Exception('The user does not exist');
            }

            return $user;
        }

        return false;
    }
}
