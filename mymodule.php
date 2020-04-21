<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\Formbase;
use Drupal\Core\Form\FormStateInterface;


class mymoduleform extends FormBase {

  public function getFormId() {
    return 'my_module_text_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state) {
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->nid->value;
    $form['usernode'] = array(
      '#title' => t('Enter the number of nodes'),
      '#type' => 'number',
      '#required' => TRUE,
    );
	$form['content'] = array(
	  '#type' => 'select',
	  '#title' => t('Select the content types'),
	  '#options' => array(0 => 'Select' , 1 => 'Article' , 2 => 'Basic page');
	);
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    $form['nid'] = array(
      '#type' => 'hidden',
      '#value' => $nid,
    );
    return $form;
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message(t('Success.'));
