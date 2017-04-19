<?php
/**
 * 管理界面的设置表单
 *
 */

namespace Drupal\manager_pages\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ManagerPagesSettingsForm extends ConfigFormBase {

    public function getFormId() {
        return 'manager_pages_settings';
    }

    protected function getEditableConfigNames() {
        return [
            'manager_pages.settings'
        ];
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('manager_pages.settings');

        # 设置默认值
        if(empty($config->get('always_display_topbar'))) {
            $config->set('always_display_topbar', 1)->save();
        }
        # 是否显示顶部工具条
        $form['display_topbar'] = [
            '#type' => 'radios',
            '#title' => $this->t('Always display the top bar ?'),
            '#default_value' => $config->get('always_display_topbar'),
            '#options' => [1 => $this->t('Yes'), 0 => $this->t('No')],
        ];

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $this->config('manager_pages.settings')
            ->set('display_topbar', $form_state->getValue('display_topbar'))
            ->save();

        parent::submitForm($form, $form_state);
    }
}