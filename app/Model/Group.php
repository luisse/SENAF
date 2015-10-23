<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 */
class Group extends AppModel {

/**
 * Display field
 *
 * @var string
 */
public $actsAs = array('Acl' => array('type' => 'requester'));


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
   public function parentNode() {
        return null;
    }
}
