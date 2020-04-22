<?php
/**
  * @file
  * Contains \Drupal\MyModule\Form\MyModuleForm
  */
namespace Drupal\My_Module\Form;

use Drupal\Core\Form\Formbase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\Messenger\MessengerTrait;

class My_Moduleform extends FormBase {
  public function getFormId() {
    return 'My_Module_new_form';
  }
    
  public function buildForm(array $form, FormStateInterface $form_state) { 
    $node_types = \Drupal\node\Entity\NodeType::loadMultiple();
    $options = [];
    foreach ($node_types as $node_type) {
      $options[$node_type->id()] = $node_type->label();
    }
    $form['usernodes'] = [
      '#title' => t('Enter number'),
      '#type' => 'number',
      '#required' => TRUE,
    ];
	$form['content'] = [
	  '#title' => t('Select content types'),
	  '#type' => 'select',
	  '#options' => $options,
	  '#required' => TRUE,
	];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit'),
    ];
    $form['nid'] = [
      '#type' => 'hidden',
      '#value' => $nid,
    ];
    return $form;
  }
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $abc = $form_state->getValue('usernodes');
	for($i=0; $i<$abc; $i++{
	  $node = Node::create([
              'type' => 'Article',
              'title' => 'My Node',
              'langcode' => 'en',
              'uid' => '1',
              'status' => 1,
              'field_fields' => array(),
            )];
			$node->save(); 
    }
	$this->messenger()->addMessage('Success');
  }
}
