<?php namespace Ixudra\Imageable\Models\Response;


class BaseModelResponse {

    protected $model;

    protected $input;

    protected $notifications;


    public function __construct($model = null, $input = null)
    {
        $this->model = $model;
        $this->input = $input;
        $this->notifications = array();
    }


    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function setInput($input)
    {
        $this->input = $input;
    }

    public function getNotifications($type)
    {
        if( !isset($this->notifications[$type]) ) {
            return array();
        }

        return $this->notifications[$type];
    }

    public function addNotifications($type, $notifications, $translate = false)
    {
        if( !isset($this->notifications[$type]) ) {
            $this->notifications[$type] = array();
        }

        foreach( $notifications as $notification ) {
            $message = $notification;
            if( $translate ) {
                $message = Translate::model($notification);
            }

            array_push($this->notifications[$type], $message);
        }
    }

    public function isSuccessful()
    {
        return !isset($this->notifications['error']) || empty($this->notifications['error']);
    }

    public function isUnsuccessful()
    {
        return !$this->isSuccessful();
    }

}
